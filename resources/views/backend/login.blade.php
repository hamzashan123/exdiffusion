@extends('layouts.admin-auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image column1">
                            <img src="https://colorlib.com/etc/lf/Login_v1/images/img-01.png"/>
                        </div>
                        <div class="col-lg-6 column2">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">ADMIN LOGIN!</h1>
                                </div>
                                <form class="user" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="email" value="{{ old('email') }}"
                                               class="form-control form-control-user"
                                               placeholder="Enter Your email">
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="form-group input-group mb-3">
                                        <input type="password" name="password" id="passwordInput" value="{{ old('password') }}"
                                               class="form-control form-control-user"
                                               placeholder="Enter Your Password">
                                               <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                        <i class="fa fa-eye" id="eyeIcon"></i>
                                                    </button>
                                                </div>       
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input"
                                                   name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div> -->
                                    <button class="btn btn-primary btn-user btn-block" type="submit" name="login">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('admin.forgot_password') }}">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
        $(document).ready(function () {
            const passwordInput = $('#passwordInput');
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
        });
</script>
@endsection
