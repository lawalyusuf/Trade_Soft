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

    public function from(){
        $countries = Country::whereReceiver(false)->with('currencies')->get();
        return response()->json([
            'countries' => $countries
        ],200);
    }

    public function fromInit(){
        $country = Country::whereCode("NGA")->with('currencies')->first();
        return response()->json([
            'country' => $country
        ],200);
    }

    public function getCountry(Request $request){
        $this->validate($request, [
            'country' => 'required',
        ]);
        $country = Country::whereCode($request->country)->with('currencies')->first();
        return response()->json([
            'country' => $country
        ],200);
    }

    public function toInit(){
        $country = Country::whereCode("GBR")->with('currencies')->first();
        return response()->json([
            'country' => $country
        ],200);
    }
}
