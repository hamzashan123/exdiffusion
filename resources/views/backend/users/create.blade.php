@extends('layouts.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                Create user
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Back to users</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="first_name" class="text-small text-uppercase">{{ __('First Name') }}</label>
                            <input id="first_name" type="text" class="form-control form-control-lg" name="first_name"
                                   value="{{ old('first_name') }}" placeholder="First Name">
                            @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="last_name" class="text-small text-uppercase">{{ __('Last Name') }}</label>
                            <input id="last_name" type="text" class="form-control form-control-lg" name="last_name"
                                   value="{{ old('last_name') }}" placeholder="Last Name">
                            @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email" class="text-small text-uppercase">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg" name="email"
                                   placeholder="Enter your Email">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control form-control-lg">
                                <option value="">-- Choose Status User --</option>
                                <option value="1" {{ old('status') == "1" ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status') == "0" ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                    <div class="col-6">
                        <div class="form-group">
                            <label for="user_country">Country</label>
                            <select name="user_country" id="user_country" class="form-control" >
                                @include('frontend.pages.countries')
                            </select>
                            @error('user_country')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group">
                        <label for="user_occupation">Occupation</label>
                        <select name="user_occupation" id="user_occupation" class="form-control" >
                            <option value="">Select Occupation</option>
                            <option value="Accounting & Finance">Accounting & Finance</option>
                            <option value="Arts & Design">Arts & Design</option>
                            <option value="Education & Training">Education & Training</option>
                            <option value="Engineering & Architecture">Engineering & Architecture</option>
                            <option value="Healthcare & Medical">Healthcare & Medical</option>
                            <option value="Human Resources">Human Resources</option>
                            <option value="IT & Software">IT & Software</option>
                            <option value="Legal">Legal</option>
                            <option value="Marketing & Sales">Marketing & Sales</option>
                            <option value="Media & Communication">Media & Communication</option>
                            <option value="Retail & Customer Service">Retail & Customer Service</option>
                            <option value="Science & Research">Science & Research</option>
                            <option value="Skilled Trades">Skilled Trades</option>
                            <option value="Transportation & Logistics">Transportation & Logistics</option>
                            <option value="Other">Other</option>
                        </select>
                            @error('user_occupation')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password" class="text-small text-uppercase">{{ __('New Password') }}</label>
                            <input id="password" type="password" class="form-control form-control-lg"
                                   name="password"
                                   placeholder="Enter your password">
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password-confirm"
                                   class="text-small text-uppercase">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg"
                                   name="password_confirmation" placeholder="Confirm Password">
                            @error('password-confirm')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <label for="user_image">User image</label>
                        <br>
                        <div class="form-group">
                            <input type="file" name="user_image">
                        </div>
                        @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
