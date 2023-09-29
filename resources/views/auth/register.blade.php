@extends('layouts.app')
@section('title', 'Registration')
@section('content')

<div id="signupModal">
    <div>
        <div class="modal-content">

            @if(session()->has('message'))
            <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert" id="alert-message">
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>

            </div>
            <h5 id="RegisterError" style="color:red"></h5>
            <div class="modal-body">
                <form method="POST" action="{{route('register')}}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control">
                        @error('email')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                        <input type="password" name="password" id="signupUserPassword" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fa fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        </div>
                        
                        @error('password')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="input-group">
                        <input type="password" name="password_confirmation" id="signupUserconfirmPassword" class="form-control">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                                <i class="fa fa-eye" id="eyeIcon1"></i>
                            </button>
                        </div>
                        </div>
                        
                        @error('password_confirmation')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                    </div>

                    <div class="form-group signupPopupBtn">
                        <button class="btn btn-primary" id="signUpBtn">Sign Up</button>

                    </div>

                    <div class="form-group donthaveaccount">


                        Already have an account? &nbsp; <a href="{{route('login')}}" class="donthaveaccount"> Sign in </a>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
        $(document).ready(function () {
            const passwordInput = $('#signupUserPassword');
            const eyeIcon = $('#eyeIcon');
            const togglePassword = $('#togglePassword');

            togglePassword.click(function () {
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            const signupUserconfirmPassword = $('#signupUserconfirmPassword');
            const eyeIcon1 = $('#eyeIcon1');
            const togglePassword1 = $('#togglePassword1');

            togglePassword1.click(function () {
                if (signupUserconfirmPassword.attr('type') === 'password') {
                    signupUserconfirmPassword.attr('type', 'text');
                    eyeIcon1.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    signupUserconfirmPassword   .attr('type', 'password');
                    eyeIcon1.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
</script>
