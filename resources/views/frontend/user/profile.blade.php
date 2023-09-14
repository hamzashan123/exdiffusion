@extends('layouts.app')
@section('title', 'User Profile')
@section('content')
    <section class="breadcrumb-area pt-5 pb-5" style="background-color: #09c6a2">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h2>Dashboard</h2>
                <ul>
                    <li><a href="{{route('home')}}">home</a></li>
                    <li> My profile</li>
                </ul>
            </div>
        </div>
    </section>
   
    <section class="container pt-4 pb-5 login-form-container">
        <div class="row">
       
            <div class="col-lg-8">
            @if(Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}</p>
    @endif
                <form action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-lg-12 text-center mb-4">
                            @if(auth()->user()->user_image)
                                <img src="{{ asset('storage/images/users/' . auth()->user()->user_image) }}"
                                     class="img-thumbnail" width="120"
                                     alt="{{ auth()->user()->full_name }}">
                                <div class="mt-2">
                                    <a href="{{ route('user.remove_image') }}" class="btn btn-sm btn-outline-danger">Remove image</a>
                                </div>
                            @else
                                <img src="{{ asset('img/avatar.png') }}"
                                     class="img-thumbnail" width="120"
                                     alt="{{ auth()->user()->full_name }}">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="first_name" class="text-small text-uppercase">First Name</label>
                            <input type="text" class="form-control form-control-lg"
                                   name="first_name" id="first_name"
                                   value="{{ old('first_name', auth()->user()->first_name) }}">
                            @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-lg-6 form-group">
                            <label for="last_name" class="text-small text-uppercase">Last Name</label>
                            <input type="text" class="form-control form-control-lg"
                                   name="last_name" id="last_name"
                                   value="{{ old('last_name', auth()->user()->last_name) }}">
                            @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-lg-6 form-group">
                            <label for="email" class="text-small text-uppercase">Email</label>
                            <input type="email" class="form-control form-control-lg"
                                   name="email" id="email"
                                   value="{{ old('email', auth()->user()->email) }}">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-lg-6 form-group">
                            <label for="phone" class="text-small text-uppercase">Phone Number</label>
                            <input type="text" class="form-control form-control-lg"
                                   name="phone" id="phone"
                                   placeholder="ex. 9665xxxxxxxx"
                                   value="{{ old('phone', auth()->user()->phone) }}">
                            @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="last_name" class="text-small text-uppercase">{{ __('Business Name*') }}</label>
                                <input id="business_name" type="text" class="form-control form-control-lg" name="business_name" value="{{ old('business_name', auth()->user()->business_name) }}" placeholder="Business Name">
                                @error('business_name')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <h4 style="margin-left: 15px; font-weight:500">Business Address*:</h4>
                                      
                                      <div class="col-12">
                                          <div class="form-group">
                                              <!-- <label for="last_name" class="text-small text-uppercase">{{ __('Address Line 1') }}</label> -->
                                              <input id="address_line1" type="text" class="form-control form-control-lg" name="address_line1" value="{{ old('address_line1', auth()->user()->address_line1) }}"  placeholder="Address Line 1">
                                              @error('address_line1')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                          </div>
                                      </div>

                                      <div class="col-12">
                                          <div class="form-group">
                                              <!-- <label for="last_name" class="text-small text-uppercase">{{ __('Address Line 2') }}</label> -->
                                              <input id="address_line2" type="text" class="form-control form-control-lg" name="address_line2" value="{{ old('address_line2', auth()->user()->address_line2) }}" placeholder="Address Line 2">
                                              @error('address_line2')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                          </div>
                                      </div>

                                      <div class="col-4">
                                          <div class="form-group">
                                             
                                              <input id="city" type="text" class="form-control form-control-lg" name="city" value="{{ old('city', auth()->user()->city) }}"  placeholder="City">
                                              @error('city')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                          </div>
                                      </div>
                                      <div class="col-4">
                                          <div class="form-group">
                                             
                                              <input id="state" type="text" class="form-control form-control-lg" name="state" value="{{ old('state', auth()->user()->state) }}"  placeholder="State / Province / Region">
                                              @error('state')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                          </div>
                                      </div>
                                      <div class="col-4">
                                            <div class="form-group">
                                                
                                                <input id="zip_code" type="text" class="form-control form-control-lg" name="zip_code" value="{{ old('zip_code', auth()->user()->zip_code) }}"  placeholder="Postal / Zip Code">
                                                @error('zip_code')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                      </div>

                                      <div class="col-12">
                                            <div class="form-group">
                                                <label for="website" class="text-small text-uppercase">{{ __('Website') }}</label>
                                                <input id="website" type="text" class="form-control form-control-lg" name="website" value="{{ old('website', auth()->user()->website) }}"  placeholder="Website">
                                                @error('website')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                        <h4 style="margin-left: 15px; font-weight:500">A little about your business model</h4>

                                      <div class="col-12">
                                            <div class="form-group">
                                            <label for="website" class="text-small text-uppercase">{{ __('Do you currently own /​ rent premises that will be open to the general public?') }}</label>
                                            <br>
                                            <input type="radio"  name="own_rent" value="yes" checked /> &nbsp; Yes 
                                            &nbsp;
                                            <input type="radio" name="own_rent" value="no" />&nbsp; No 
                                                
                                               
                                            </div>
                                      </div>

                                      <div class="col-12">
                                            <div class="form-group">
                                                <label for="open_store_time" class="text-small text-uppercase"> I'm looking to open my store in... </label>
                                                <select class="form-control" name="open_store_time">
                                                    @if(!empty(isset(auth()->user()->open_store_time)))
                                                    <option value="{{ auth()->user()->open_store_time }}" selected>{{ auth()->user()->open_store_time }}</option>
                                                    @endif
                                                    <option value="My Store is already open"> My Store is already open</option>
                                                    <option value="< 3 Months"> < 3 Months</option>
                                                    <option value="6-12 Months"> 6-12 Months</option>
                                                    <option value="12 Months+"> 12 Months+</option>

                                                </select>
                                                @error('open_store_time')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>

                                        <h5 style="margin-left: 15px;">Business Strategy*</h5>

                                        <div class="col-12">
                                            <div class="form-group">
                                                &nbsp;  
                                                <input type="checkbox" name="business_strategy[]" value="bricks_mortar" checked >
                                                Bricks & Mortar    
                                                &nbsp;
                                                <input type="checkbox" name="business_strategy[]" value="ecommerce" > 
                                                Ecommerce
                                                &nbsp;
                                                <input type="checkbox" name="business_strategy[]" value="drop_shipping" >  
                                                Drop Shipping

                                                @error('open_store_time')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="col-12">
                                            <div class="form-group">
                                                <label for="sourcing" class="text-small text-uppercase">{{ __('Where are you sourcing your goods from? (Suppliers etc.)*') }}</label>
                                                <input id="sourcing" type="text" class="form-control form-control-lg" name="sourcing" value="{{ old('sourcing', auth()->user()->sourcing) }}"  placeholder="KOIMPORTS LTD OR Other...">
                                                @error('sourcing')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                            </div>
                                        </div> -->

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="business_description" class="text-small text-uppercase">{{ __('Brief business description*') }}</label>
                                                <textarea id="business_description" name="business_description" value="{{ old('business_description') }}" placeholder="Is there anything you would like to mention?" > </textarea>
                                                @error('business_description')<span class="text-danger" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                We need to understand a little more about your business.
                                                <br> <br>
                                                Thank you so much for expressing an interest in becoming an aquatic retailer. We will be in touch should you qualify for an account application.
                                               
                                            </div>
                                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="password" class="text-small text-uppercase">
                                Password
                                <small class="ml-auto text-secondary">(optional)</small>
                            </label>
                            <input type="password" class="form-control form-control-lg"
                                   name="password" id="email"
                                   value="{{ old('password') }}">
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="password_confirmation" class="text-small text-uppercase">Re-Password</label>
                            <input type="password" class="form-control form-control-lg"
                                   name="password_confirmation" id="password_confirmation"
                                   value="{{ old('password_confirmation') }}">
                            @error('password-confirm')<span class="text-danger"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                         


                    </div>
                    <!-- <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="receive-email">Receive Email</label>
                            <select name="receive_email" id="receive-email" class="form-control">
                                <option value="">---</option>
                                <option value="1" {{ old('receive_email', auth()->user()->receive_email) == 1 ? 'selected' : null }}>Yes</option>
                                <option value="0" {{ old('receive_email', auth()->user()->receive_email) == 0 ? 'selected' : null }}>No</option>
                            </select>
                            @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div> -->
                         
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <label for="user_image" class="text-small text-uppercase">Image</label>
                            <input type="file" id="user_image" name="user_image"><br>
                            @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 button-box">
                            <button class="default-btn" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4">
                @include('partials.frontend.user.sidebar')
            </div>
        </div>
    </section>
@endsection
