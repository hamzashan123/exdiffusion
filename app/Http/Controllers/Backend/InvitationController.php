<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\InviteApprove;
use App\Mail\UserInvite;
use App\Models\User;
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

                $admindata = [
                    'admin' => true,
                    'firstname' => $request->invite_first_name,
                    'lastname' => $request->invite_lastname,
                    'email' => $request->invite_email,
                    'subject' => 'Exdiffusion User Invite',
                    'msg' => "New invitation has been received. You can now login to Exdiffusion  <a href='" . route('admin.login') . "'>Admin</a> accept or decline invite."
                ];

                // try {

                    $adminemail = User::role('admin')->first();
                    Mail::to($adminemail->email)->send(new UserInvite($admindata));
                // } catch (\Exception $e) {
                // }

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'msg' => "Invite Sent Successfully!"
            ]);
        } 

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

            return redirect()->back()->with('failed','Request Declined!');
        }
        
    }
}
