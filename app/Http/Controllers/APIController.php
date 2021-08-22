<?php

namespace App\Http\Controllers;

use App\Models\Convert;
use App\Models\User;
use App\Models\Recipient;
use App\Models\Transaction;
use App\Notifications\RecipientNotification;
use App\Notifications\TransactionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class APIController extends Controller
{
    public function addRecipient(Request $request){
        $this->validate($request, [
            'country' => 'required',
            'bank' => 'required',
            'account_number' => 'required',
            'account_name' => 'required|string',
            'ddd' => 'required',
        ]);

        $recipent = new Recipient();

        if($recipent->check($request->ddd,$request->account_number )){
            return response()->json([
                'error' => 'already added the account'
            ],404);
        }

        $user = User::findOrFail($request->ddd);


        $recipent->user_id = $user->id;
        $recipent->account_number = $request->account_number;
        $recipent->account_name = $request->account_name;
        $recipent->bank = $request->bank['BankID'];
        $recipent->country = $request->country['Code'];

        $save = $recipent->save();


        $receiver = $user;
        Notification::send($receiver, new RecipientNotification($recipent, 'You added ' .$recipent->account_name.'  to your receipent list' ));

        if($save){
            return response()->json([
                'message' => 'saved'
            ],200);
        }else{
            return response()->json([
                'error' => 'error'
            ],404);
        }
    }

    public function removeRecipient(Request $request){
        $this->validate($request, [
            'id' => 'required',
            'ddd' => 'required'
        ]);

        $recipent = Recipient::findOrFail($request->id);

        $receiver = User::findOrFail($request->ddd);
        Notification::send($receiver, new RecipientNotification($recipent, 'You have removed ' .$recipent->account_name.'  from your receipent list' ));

        if($recipent->delete()){
            return response()->json([
                'message' => 'deleted'
            ],200);
        }else{
            return response()->json([
                'error' => 'error'
            ],404);
        }
    }

    public function rate(Request $request){
        $this->validate($request, [
            'fromCurrency' => 'required|string',
            'toCurrency' => 'required|string',
        ]);

        $rate = Convert::where("fromCurrency", $request->fromCurrency)->where("toCurrency", $request->toCurrency)->first('rate');
        return response()->json([
            'rate' => $rate
        ],200);
    }

    public function addTransaction(Request $request){
        $this->validate($request, [
            'toCountry' => 'required',
            'fromCountry' => 'required',
            'amount' => 'required',
            'ddd' => 'required',
            'recipient' => 'required'
        ]);

        $recipient = Recipient::findOrFail($request->recipient['id']);
        $user = User::whereId($request->ddd['id'])->first();

        $transaction = new Transaction();

        $transaction->user_id = $user->id;
        $transaction->receiver_id = $recipient->id;
        $transaction->receiver_name = $recipient->account_name;
        $transaction->amount = $request->amount;
        $transaction->fromCountry = $request->fromCountry['id'];
        $transaction->toCountry = $request->toCountry['id'];
        $ref = str_word_count($recipient->account_name, 1);
        $transaction->reference = $ref[0].'ST'.rand(1111, 999999);
        $transaction->trans_id = 'ST'.rand(1111, 999999);

        $save = $transaction->save();


        $receiver = $user;
        Notification::send($receiver, new TransactionNotification($transaction, 'You initiate a payment for ' .$transaction->receiver_name.'  continue to payment to complete transaction' ));

        if($save){
            return response()->json([
                'message' => 'saved'
            ],200);
        }else{
            return response()->json([
                'error' => 'error'
            ],404);
        }
    }
}
