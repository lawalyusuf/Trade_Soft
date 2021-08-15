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
        $recipients = Recipient::whereUser_id(auth()->user()->id)->get(['id','country','bank','account_number','user_id', 'account_name']);
        $recipients->transform(function($recipient){
            $recipient->country = Country::whereCode($recipient->country)->first(['name', 'code', 'currency', 'PhonenumberPrefix', 'Iso2Code']);
            $recipient->bank = Bank::where('BankID',$recipient->bank)->first(['BankID','Name','Bank','CountryCode', 'Code']);
            return $recipient;
        });
        return $recipients;
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
