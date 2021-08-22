<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        return view('transaction.index');
    }

    public function history(){
        return view('transaction.history');
    }

    public function status(){
        $transaction = Transaction::lastTransaction();
        // return $transaction;
        return view('transaction.pending', ['transaction' => $transaction]);
    }

    public function show($id){
        $transaction = Transaction::getTransactionById($id);
        return view('transaction.pending', ['transaction' => $transaction]);
    }
}
