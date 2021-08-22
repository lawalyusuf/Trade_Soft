<?php

namespace App\Models;

use App\Models\Convert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'amount',
        'currency',
        'trans_id',
        'reference',
        'receiver_id',
        'receiver_name',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function lastTransaction(){
        $transaction = Transaction::whereUser_id(auth()->user()->id)->withTrashed()->latest()->first();
        $transaction->fromCountry = Country::findOrFail($transaction->fromCountry);
        $transaction->toCountry = Country::findOrFail($transaction->toCountry);
        $transaction->receiver = Recipient::whereId($transaction->receiver_id)->withTrashed()->first();
        $transaction->receiver->bank = bank::where('BankID',$transaction->receiver->bank)->first();
        $transaction->toCurrency = Currency::whereCode($transaction->toCountry->Currency)->first();
        $transaction->fromCurrency = Currency::whereCode($transaction->fromCountry->Currency)->first();
        $transaction->rate = Convert::where("fromCurrency", $transaction->fromCurrency->Code)->where("toCurrency", $transaction->toCurrency->Code)->first('rate');

        $transaction->amountReceiver = $transaction->amount * $transaction->rate->rate;
        return $transaction;
    }

    public static function getTransactionById($id){
        $transaction = Transaction::wheretrans_id($id)->withTrashed()->first();
        $transaction->fromCountry = Country::findOrFail($transaction->fromCountry);
        $transaction->toCountry = Country::findOrFail($transaction->toCountry);
        $transaction->receiver = Recipient::whereId($transaction->receiver_id)->withTrashed()->first();
        $transaction->receiver->bank = bank::where('BankID',$transaction->receiver->bank)->first();
        $transaction->toCurrency = Currency::whereCode($transaction->toCountry->Currency)->first();
        $transaction->fromCurrency = Currency::whereCode($transaction->fromCountry->Currency)->first();
        $transaction->rate = Convert::where("fromCurrency", $transaction->fromCurrency->Code)->where("toCurrency", $transaction->toCurrency->Code)->first('rate');

        $transaction->amountReceiver = $transaction->amount * $transaction->rate->rate;
        return $transaction;
    }
}
