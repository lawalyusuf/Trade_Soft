@extends("layouts.app")

@section("title")
Referal a Friend
@endsection

@section("content")
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-sm-0 font-size-18">Referal a Friend</h4>
</div>
<div class="col-md-7 p-0">
    <div class="subscribe3">
        <div class="sub-form-con bg-sub-reg">
            <div class="p-5">
                <h4 class="text-more2 pt-1 text-white opacity-4">Referal a Friend</h4>
                <h1 class="text-head-3 pt-1 text-white">Tell a friend <br>about us</h1>
                <form class="subscribe-form needs-validation" novalidate method="POST" action="{{ route('referal.post') }}">
                    @csrf
                    @include("partials.alert")
                    <div class="form-group mt-5">
                        <label class="sub-label opacity-4">First Name</label>
                        <input type="text" name="first_name" required value="{{ old('first_name') }}" class="form-control p-form  @error('first_name') is-invalid @enderror">
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-5">
                        <label class="sub-label opacity-4">Last Name</label>
                        <input type="text" name="last_name" required value="{{ old('last_name') }}" class="form-control bg-transparent p-form  @error('last_name') is-invalid @enderror">
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-5">
                        <label class="sub-label opacity-4">Email</label>
                        <input type="email" name="email" required value="{{ old('email') }}" class="form-control bg-transparent p-form  @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-5">
                        <label class="sub-label opacity-4">Phone</label>
                        <input type="text" name="phone" required value="{{ old('phone') }}" class="form-control bg-transparent p-form  @error('phone') is-invalid @enderror">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <button style="submit" class="btn-white mt-5">Tell a friend</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
            }, false);
        })();
    </script>
</div>


@endsection
