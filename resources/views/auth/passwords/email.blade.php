@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
    
<div id="signupModal">
    <div>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Forget Password</h5>

            </div>
            <h5 id="RegisterError" style="color:red"></h5>
            <div class="modal-body">

                                <form action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <div class="form-group">            
                                    <label for="email">Email*</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Your Email">
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="form-group signupPopupBtn">
                                       
                                            <button class="btn btn-primary" type="submit">Send Password Reset Link</button>
                                    
                                        
                                    </div>


                                    
                                </form>
                                </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

