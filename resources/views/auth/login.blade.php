@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <div class="row p-0">
        <div class="col-md-5 p-0 d-none d-lg-block">
            <img src="{{ asset('soft/assets/img/login.png') }}" width="100%" height="700px">
        </div>
        <div class="col-md-7 p-0">
            <div class="subscribe2">
                <div class="sub-form-con bg-sub">
                    <div class="p-5">
                        <h4 class="text-more2 pt-1 text-white opacity-4">WELCOME BACK</h4>
                        <h1 class="text-head2 pt-1 text-white">Login To View <br>Your Account</h1>
                        @include("partials.alert")
                        <form class="subscribe-form" method="POST" action="{{ route('user.login') }}">
                            @csrf
                            <div class="form-group mt-5">
                                <label class="sub-label opacity-4">Email Address</label>
                                <input type="email" name="email" class="form-control p-form">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mt-5">
                                <label class="sub-label opacity-4">Password</label>
                                <input type="password" name="password" class="form-control bg-transparent p-form">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn-p2 mt-5" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 offset-md-5 d-lg-flex justify-content-between px-5 py-5">
            @if (Route::has('user.forgot'))
                <h4 class="text-log">Forgot Password? <a href="{{ route('user.forgot') }}" class="active">Click here</a></h4>
            @endif
            @if (Route::has('user.register'))
                <h4 class="text-log">Not a user? <a href="{{ route('user.register') }}" class="active">Create account</a></h4>
            @endif
        </div>
    </div>
</div>
@endsection
