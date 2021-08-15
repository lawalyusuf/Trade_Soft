<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'country',
        'account_name',
        'bank',
        'account_number',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function check($user_id, $account_number){
        $check = Recipient::whereUser_id($user_id)->whereAccount_number($account_number)->first();
        if($check){
            return true;
        }else{
            return false;
        }
    }

    public function bank(){
        return $this->belongsTo(Bank::class);
    }
}
