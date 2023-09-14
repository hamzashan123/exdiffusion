<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserSignUp;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'business_name' => ['required'],
            'address_line1' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'zip_code' => ['required'],
            'business_strategy' => ['required'],
            // 'sourcing' => ['required'],
            'business_description' => ['required'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:128', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
      // dd($data);
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'business_name' => $data['business_name'],
            'address_line1' => $data['address_line1'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'website' => $data['website'],
            'own_rent' => $data['own_rent'],
            'open_store_time' => $data['open_store_time'],
            'business_strategy' => json_encode($data['business_strategy']),
            // 'sourcing' => $data['sourcing'],
            'business_description' => $data['business_description'],
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($data['password']),
            'status' => false
        ]);

        $user->assignRole('user');

        $userdata = [
            'admin' => false,
            'firstname' => $user->first_name,
            'lastname' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
            'subject' => 'Registration Successful',
            'msg' => 'You have successfully registered to koimports.co.uk . Your Account is Under Reviewed. As soon as it will active you will receive an updates through Email.'
        ];

        try {
            Mail::to($user->email)->send(new UserSignUp($userdata));
            Session::flash('success', 'Registration Successfull!'); 
        } catch (\Exception $e) {
          
        }

        $admindata = [
            'admin' => true,
            'firstname' => $user->first_name,
            'lastname' => $user->last_name,
            'username' => $user->username,
            'email' => $user->email,
            'subject' => 'KOImports User Registration',
            'msg' => 'A new user registered into koimports.co.uk . Please check the admin and change status to active also assign customer type.'
        ];

        try {
            
            $adminemail = User::role('admin')->first();
            Mail::to($adminemail->email)->send(new UserSignUp($admindata));
        } catch (\Exception $e) {
          
        }

        return $user;
    }
}
