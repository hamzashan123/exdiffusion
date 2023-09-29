@extends('layouts.app')
@section('title', 'Login')
@section('content')

<!-- login-area start -->
<div id="signupModal">
    <div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign In</h5>

            </div>
            <h5 id="RegisterError" style="color:red"></h5>
            <div class="modal-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password*</label>
                        <div class="input-group mb-3">
                            <input id="passwordInputUser" type="password" class="form-control" name="password" placeholder="password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fa fa-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>


                    <div class="form-group signupPopupBtn">
                        <button class="btn btn-primary">{{ __('Sign In') }}</button>
                    </div>

                    <div class="form-group donthaveaccount">


                        Don't have an account? &nbsp; <a href="{{route('register')}}" class="donthaveaccount"> Sign Up </a>


                    </div>





                    <div class="form-group donthaveaccount">
                        @if (Route::has('password.request'))
                        <a class="btn btn-link " href="{{ route('password.request') }}" style="color:white; font-size:17px">
                            {{ __('Forgot Password?') }}
                        </a>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- login-area end -->
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function() {
        const passwordInput = $('#passwordInputUser');
        const eyeIcon = $('#eyeIcon');
        const togglePassword = $('#togglePassword');

        togglePassword.click(function() {
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>