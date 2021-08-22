<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipientController extends Controller
{
    public function index(){
        // return auth()->user()->unreadNotifications;

        return view('recipient.index');
    }
}
