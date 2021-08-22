@extends('layouts.auth')
@section('title')
Continue Registration
@endsection
@section('content')
<div class="container py-5">
    <div class="row p-0">
        <div class="col-md-5 p-0 d-none d-lg-block">
            <img src="{{ asset('soft/assets/img/register.png') }}" width="100%" height="900px">
        </div>
        <div class="col-md-7 p-0">
            <div class="subscribe3">
                <div class="sub-form-con bg-sub-reg">
                    <div class="p-5">
                        <h4 class="text-more2 pt-1 text-white opacity-4">JUMP RIGHT IN</h4>
                        <h1 class="text-head-3 pt-1 text-white">Create an account <br>to get started</h1>
                        <form class="subscribe-form" method="POST" action="{{ route('post.continue') }}">
                            @csrf
                            @include("partials.alert")
                            <div class="form-group mt-5">
                                <label class="sub-label opacity-4">Full Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control p-form @error('name') is-invalid @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-5">
                                <label class="sub-label opacity-4">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control p-form @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group mt-5">
                                <label class="sub-label opacity-4">Password</label>
                                <input type="password" name="password" class="form-control bg-transparent p-form @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-5">
                                <label class="sub-label opacity-4">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control bg-transparent p-form @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button style="submit" class="btn-white mt-5">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 offset-md-5 d-lg-flex justify-content-end px-5 py-5">
            @if (Route::has('user.login'))
                <h4 class="text-log">Already a user? <a href="{{ route('user.login') }}" class="active">Login</a></h4>
            @endif
        </div>
    </div>
</div>
@endsection
