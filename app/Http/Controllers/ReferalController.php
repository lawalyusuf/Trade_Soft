<?php

namespace App\Http\Controllers;

use App\Models\Referal;
use Illuminate\Http\Request;

class ReferalController extends Controller
{
    public function index(){
        return view('referal.index');
    }

    public function post(Request $request){
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $referal = new Referal();

        $referal->first_name = $request->first_name;
        $referal->last_name = $request->last_name;
        $referal->email = $request->email;
        $referal->phone = $request->phone;

        $referal->save();

        return redirect()->back()->with('success', 'Thanks for your referal');
    }
}
