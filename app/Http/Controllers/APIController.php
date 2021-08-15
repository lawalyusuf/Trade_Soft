<?php

namespace App\Http\Controllers;

use App\Models\Recipient;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function addRecipient(Request $request){
        $this->validate($request, [
            'country' => 'required',
            'bank' => 'required',
            'account_number' => 'required',
            'account_name' => 'required|string',
            'ddd' => 'required|string',
        ]);

        $recipent = new Recipient();

        if($recipent->check($request->ddd,$request->account_number )){
            return response()->json([
                'error' => 'already added the account'
            ],404);
        }

        $recipent->user_id = $request->ddd;
        $recipent->account_number = $request->account_number;
        $recipent->account_name = $request->account_name;
        $recipent->bank = $request->bank['BankID'];
        $recipent->country = $request->country['Code'];



        if($recipent->save()){
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
        ]);

        $recipent = Recipient::findOrFail($request->id);

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
}
