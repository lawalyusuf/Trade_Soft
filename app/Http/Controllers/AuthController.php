<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout() {
        Auth::logout();
        return redirect()->route('user.login');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function continue(){
        return view('auth.continue');
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'password' => 'required',
            'email' => 'required|email'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error', 'Account not found');
        }
    }

    public function postContinue(Request $request){
        $this->validate($request, [
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'name' => 'required',
        ]);

        $user_info = $request->session()->get("user_info");

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $user_info['phone'];
        $user->address1 = $user_info['first_address'];
        $user->address2 = $user_info['second_address'];
        $user->town =$user_info['town'];
        $user->postal = $user_info['postal'];
        $user->password = bcrypt($request->password);

        if($user->save()){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('dashboard');
            }
        }else{
            return redirect()->back()->with('error', 'Cannot create your account now');

        }




    }

    public function postRegister(Request $request){
        $this->validate($request, [
            'phone' => 'required',
            'first_address' => 'required',
            'town' => 'required',
            'postal' => 'required',
        ]);

        $user_info = $request->all();


        $request->session()->put('user_info', $user_info);

        return redirect()->route('continue.register');

    }

    public function conRegister(Request $request){
        $user_info = $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);


        $request->session()->put('user_info', $user_info);

        return redirect()->route('continue.register');

    }
}
