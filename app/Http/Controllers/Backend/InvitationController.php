<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\InviteApprove;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{


    public function index(){

        $this->authorize('access_user');

        $invites = DB::table('invites')->get();

        return view('backend.users.invite-user',compact('invites'));
    }

    public function sendInvite(Request $request){

        $user = DB::table('invites')->where('email', $request->invite_email)->exists();

        if($user == true){
            return response()->json([
                'status' => 'failed',
                'code' => 201,
                'msg' => "Invite Already Sent!"
            ]);
        }else{
            $user = DB::table('invites')->insertGetId([
                'first_name' => $request->invite_first_name,
                'last_name' => $request->invite_lastname,
                'email' => $request->invite_email,
                'country' => $request->invite_country,
                'occupation' => $request->invite_occupation,
                'status' => 'pending',
                'created_at' => now(),
                'update_at' => now()
            ]);

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'msg' => "Invite Sent Successfully!"
            ]);
        }
        

        

        // $userdata = [
        //     'admin' => false,
        //     'firstname' => $user->first_name,
        //     'lastname' => $user->last_name,
        //     'username' => $user->username,
        //     'email' => $user->email,
        //     'subject' => 'Registration Successful',
        //     'msg' => 'You have successfully registered . Your Account is Under Reviewed. As soon as it will active you will receive an updates through Email.'
        // ];

        // try {
        //     Mail::to($user->email)->send(new UserSignUp($userdata));
        //     Session::flash('success', 'Registration Successfull!');
        // } catch (\Exception $e) {
        // }

        // $admindata = [
        //     'admin' => true,
        //     'firstname' => $user->invite_first_name,
        //     'lastname' => $user->invite_last_name,
        //     'username' => $user->username,
        //     'email' => $user->email,
        //     'subject' => 'KOImports User Registration',
        //     'msg' => 'A new user registered'
        // ];

        // try {

        //     $adminemail = User::role('admin')->first();
        //     Mail::to($adminemail->email)->send(new UserSignUp($admindata));
        // } catch (\Exception $e) {
        // }

        

    }

    public function changeStatus(int $id, string $status){

       
        $this->authorize('access_user');

        $user = DB::table('invites')->where('id',$id)->first();
        
        if(!empty($user) && $status == 'approved'){

            DB::table('invites')->where('id',$id)->update([
                'status' => 'approved'
            ]);

            $userdata = [
                'firstname' => $user->first_name,
                'lastname' => $user->last_name,
                'email' => $user->email,
                'subject' => 'Account Activated',
                'msg' => "Your invitation has been approved. You can now signup for the exdiffusion playground. <br> Click on this link to <a href='" . route('register') . "'>Sign Up</a>"
            ];
    
            
            try {
                Mail::to($user->email)->send(new InviteApprove($userdata));
            } catch (\Exception $e) {
              
            }

            return redirect()->back()->with('success','Invitation Approved!');

        }elseif(!empty($user) == true && $status == 'declined'){

            DB::table('invites')->where('id',$id)->update([
                'status' => 'declined'
            ]);

            $userdata = [
                'firstname' => $user->first_name,
                'lastname' => $user->last_name,
                'email' => $user->email,
                'subject' => 'Account Activated',
                'msg' => "Your invitation has been rejected. </a>"
            ];
    
            
            try {
                Mail::to($user->email)->send(new InviteApprove($userdata));
            } catch (\Exception $e) {
              
            }

            return redirect()->back()->with('success','Request Declined!');
        }
        
    }
}
