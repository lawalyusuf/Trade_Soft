<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index(Request $request){
        $this->validate($request, [
            'country' => 'required',
        ]);

        $banks = Bank::where('CountryCode', $request->country)->get(['Name', 'Bank', 'Iso2CountryCode', 'BankID']);

        return response()->json([
            'banks' => $banks
        ],200);
    }
}
