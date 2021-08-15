<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){
        $countries = Country::whereReceiver(true)->with('currencies')->get();
        return response()->json([
            'countries' => $countries
        ],200);
    }
}
