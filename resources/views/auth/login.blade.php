@extends('layouts.app')
@section('title', 'Login')
@section('content')
    
    <!-- login-area start -->
    <!-- <div id="login-form" class="register-area ptb-100" style="background-color: white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="form-group">
                                @if(Session::has('inactive'))
                                    <p class="alert alert-danger">{{ Session::get('inactive') }}</p>
                                @endif
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="email">Email*</label>
                                        <input type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password">Password*</label>
                                        <input id="pass" type="password" name="password" placeholder="password">
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <label class="show">Show password</label>
                                    <label class="hide"></label>
                                    <div class="form-group row mb-0">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="button-box">
                                        <button class="default-btn floatright">{{ __('Login') }}</button>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- login-area end -->
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
        $(document).ready(function () {
            $('#loginModal').modal('show');
        });
</script>

@section('script')
    
    <script>

        $('.show').click(function (){
            $(this).text('')
            $(':password').attr('type', 'text')
            $('.hide').text('Hide password')
        });

        $('.hide').click(function (){
            $(this).text('');
            $('#pass').attr('type', 'password')
            $('.show').text('Show password')
        });

    </script>
@endsection
