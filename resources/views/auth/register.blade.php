@extends('layouts.auth')

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
                        <form class="subscribe-form" method="POST" action="{{ route('user.register') }}">
                            @csrf
                            @include("partials.alert")
                            <div class="form-group mt-5">
                                <label class="sub-label opacity-4">Phone number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control p-form  @error('phone') is-invalid @enderror">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mt-5">
                                <label class="sub-label opacity-4">Address 1</label>
                                <input type="text" name="first_address" value="{{ old('first_address') }}" class="form-control bg-transparent p-form  @error('first_address') is-invalid @enderror">
                                @error('first_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-5">
                                <label class="sub-label opacity-4">Address 2</label>
                                <input type="text" name="second_address" value="{{ old('second_address') }}" class="form-control bg-transparent p-form  @error('second_address') is-invalid @enderror">
                                @error('second_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row p-0">
                                <div class="col-md-6">
                                    <div class="form-group mt-5">
                                        <label class="sub-label opacity-4">Town/County</label>
                                        <input type="text" name="town" value="{{ old('town') }}" class="form-control bg-transparent p-form  @error('town') is-invalid @enderror">
                                        @error('town')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-5">
                                        <label class="sub-label opacity-4">Postal Code</label>
                                        <input type="number" name="postal" value="{{ old('postal') }}" class="form-control bg-transparent p-form  @error('postal') is-invalid @enderror">
                                        @error('postal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
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
