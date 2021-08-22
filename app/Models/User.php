<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address1',
        'address2',
        'town',
        'postal',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function recipients(){
        $recipients = Recipient::whereUser_id(auth()->user()->id)->latest()->get(['id','country','bank','account_number','user_id', 'account_name']);
        $recipients->transform(function($recipient){
            $recipient->country = Country::whereCode($recipient->country)->first(['name', 'code', 'currency', 'PhonenumberPrefix', 'Iso2Code']);
            $recipient->bank = Bank::where('BankID',$recipient->bank)->first(['BankID','Name','Bank','CountryCode', 'Code']);
            return $recipient;
        });
        return $recipients;
    }

    public static function getTransactions(){
        $transactions = Transaction::whereUser_id(auth()->user()->id)->withTrashed()->orderBy('id', 'DESC')->get();
        $transactions->transform( function($transaction){
            $transaction->fromCountry = Country::findOrFail($transaction->fromCountry);
            $transaction->toCountry = Country::findOrFail($transaction->toCountry);
            $transaction->receiver = Recipient::whereId($transaction->receiver_id)->withTrashed()->first();
            $transaction->receiver->bank = bank::where('BankID',$transaction->receiver->bank)->first();
            $transaction->toCurrency = Currency::whereCode($transaction->toCountry->Currency)->first();
            $transaction->fromCurrency = Currency::whereCode($transaction->fromCountry->Currency)->first();
            $transaction->rate = Convert::where("fromCurrency", $transaction->fromCurrency->Code)->where("toCurrency", $transaction->toCurrency->Code)->first('rate');

            $transaction->amountReceiver = $transaction->amount * $transaction->rate->rate;

            return $transaction;
        });
        return $transactions;
    }

    public function transactions(){
        return $this->hasMany(Transaction::class)->withTrashed();
    }
}
