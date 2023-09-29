<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserSignUp;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    
    public function register(Request $request)
    {
       
        // Add your custom validation rules here
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $invitedUser = DB::table('invites')->where('email',$request->email)->first();
        
        if(!empty($invitedUser) && $invitedUser->status == 'approved') {
            
            $user = User::create([
                'first_name' => $invitedUser->first_name,
                'last_name' => $invitedUser->last_name,
                'username' => $invitedUser->first_name.'-'.$invitedUser->last_name,
                'email' => $request->email,
                'country' => $invitedUser->country,
                'occupation' => $invitedUser->occupation,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($request->password),
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
                'msg' => "You have successfully registered . Your Account is Under Reviewed. As soon as it will active you will receive an updates through Email. <br> You can <a href='" . route('login') . "'> Sign In </a> to use playground."
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
                'subject' => 'Exdiffusion User Registered',
                'msg' => 'A new user registered'
            ];

            try {

                $adminemail = User::role('admin')->first();
                Mail::to($adminemail->email)->send(new UserSignUp($admindata));
            } catch (\Exception $e) {
            }

            return redirect()->back()->with([
                'message' => 'User SignUp Successfully!',
                'alert-type' => 'success'
            ]);

        }else{
            //return $user;
            return redirect()->back()->with([
                'message' => 'Signup is only for approved user!',
                'alert-type' => 'success'
            ]);
        }


        // Sign in the user after registration (optional)
        // $this->guard()->login($user);

        // return redirect($this->redirectPath());
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    
    // protected function create(array $data)
    // {
        
    //     $invitedUser = DB::table('invites')->where('email',$data['email'])->first();
    //     if(!empty($invitedUser) && $invitedUser->status == 'approved') {
    //         dd($data);
    //         $user = User::create([
    //             'email' => $data['email'],
    //             'email_verified_at' => Carbon::now(),
    //             'password' => Hash::make($data['password']),
    //             'status' => false
    //         ]);

    //         $user->assignRole('user');

    //         $userdata = [
    //             'admin' => false,
    //             'firstname' => $user->first_name,
    //             'lastname' => $user->last_name,
    //             'username' => $user->username,
    //             'email' => $user->email,
    //             'subject' => 'Registration Successful',
    //             'msg' => 'You have successfully registered . Your Account is Under Reviewed. As soon as it will active you will receive an updates through Email.'
    //         ];

    //         try {
    //             Mail::to($user->email)->send(new UserSignUp($userdata));
    //             Session::flash('success', 'Registration Successfull!');
    //         } catch (\Exception $e) {
    //         }

    //         $admindata = [
    //             'admin' => true,
    //             'firstname' => $user->first_name,
    //             'lastname' => $user->last_name,
    //             'username' => $user->username,
    //             'email' => $user->email,
    //             'subject' => 'Exdiffusion User Registered',
    //             'msg' => 'A new user registered'
    //         ];

    //         try {

    //             $adminemail = User::role('admin')->first();
    //             Mail::to($adminemail->email)->send(new UserSignUp($admindata));
    //         } catch (\Exception $e) {
    //         }

    //         return $user;
    //     }else{
    //         //return $user;
    //         return redirect()->back()->with([
    //             'message' => 'Signup is only for approved user!',
    //             'alert-type' => 'success'
    //         ]);
    //     }

      
    // }
}
