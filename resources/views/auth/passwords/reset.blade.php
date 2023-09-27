@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')

    

<div id="signupModal">
    <div >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Reset Password</h5>
                
            </div>
            <h5 id="RegisterError" style="color:red"></h5>
            <div class="modal-body">

                                <form action="{{ route('password.update') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email"  class="form-control" placeholder="Your email" value="{{ old('email') }}">
                                        @error('email')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                    
                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password"  class="form-control" >
                                        @error('password')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" >
                                        @error('password_confirmation')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="form-group signupPopupBtn">
                                        <button  class="btn btn-primary" type="submit">Reset password</button>
                                       
                                    </div>


                                </form>
                                </div>
        </div>
    </div>
</div>
@endsection











