@extends('layouts.app')
@section('title', 'Registration')
@section('content')




<div id="signupModal">
    <div >
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
                        <input type="email" name="email"  class="form-control" >
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
                        <button  class="btn btn-primary" id="signUpBtn">Sign Up</button>
                       
                    </div>

                    <div class="form-group donthaveaccount">
                     
                            
                        Already have an account?   &nbsp; <a href="{{route('login')}}" class="donthaveaccount" >  Sign in </a>  
                          
                       
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
       // $('#signupModal').modal('show');
    });
</script>