<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\publishImageApprove;
use App\Mail\publishImageDecline;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BackendController extends Controller
{
    public function index(): View
    {
        return view('backend.index');
    }

    public function showUnReviewedImages(){
        return view('backend.publishedcreation.unrev');
    }

    public function showReviewedImages(){
        return view('backend.publishedcreation.rev');
    }
    //Un reviewed
    public function showPublishedUnReviewedImages()
    {
        $data = DB::table('creativehistory')->where('is_published', 'true')->whereIn('is_reviewed', ['false','declined'])->get();

        if ($data) {
            return response()->json([
              'status' => 'success',
              'data' => $data,
              'message' => 'Images Found!'
            ]);
        }else{
            return response()->json([
              'status' => 'failure',
              'message' => 'Something went wrong!'
            ]);
        }
    }

    //reviewed
    public function showPublishedReviewedImages()
    {
        $data = DB::table('creativehistory')->where('is_published', 'true')->whereIn('is_reviewed', ['true'])->get();

        if ($data) {
            return response()->json([
              'status' => 'success',
              'data' => $data,
              'message' => 'Images Found!'
            ]);
        }else{
            return response()->json([
              'status' => 'failure',
              'message' => 'Something went wrong!'
            ]);
        }
    }

    public function approveImage(Request $request){

        $creativeData = DB::table('creativehistory')->where('id', $request->id)->first();
        $data = DB::table('creativehistory')->where('id', $request->id)->update([
                'is_reviewed' => 'true',
                'is_nsfw_image' => $request->is_nsfw
        ]);


        $userData = User::where('id',$creativeData->user_id)->first();

        if($userData){
            $userData = [
                'admin' => false,
                'firstname' => $userData->first_name,
                'lastname' => $userData->lastname,
                'email' => $userData->email,
                'image_url' => $creativeData->image_url,
                'subject' => 'Exdiffusion Image Approved',
                'msg' => "Your image has been approved by administrator. Please find the attached images below."
              ];
        
        
              try {
                  
                  Mail::to($userData['email'])->send(new publishImageApprove($userData));
              } catch (\Exception $e) {
              }
        }
       


        if ($data) {
            return response()->json([
              'status' => 'success',
              'data' => $data,
              'message' => 'Image Approved!'
            ]);
        }else{
            return response()->json([
              'status' => 'failure',
              'message' => 'Something went wrong!'
            ]);
        }
    }

    public function declineImage(Request $request){
        
        $creativeData = DB::table('creativehistory')->where('id', $request->id)->first();

        $data = DB::table('creativehistory')->where('id', $request->id)->update([
            'is_reviewed' => 'declined',
            'is_nsfw_image' => $request->is_nsfw
        ]);

        $userData = User::where('id',$creativeData->user_id)->first();

        if($userData){
            $userData = [
                'admin' => false,
                'firstname' => $userData->first_name,
                'lastname' => $userData->lastname,
                'email' => $userData->email,
                'subject' => 'Exdiffusion Image Declined',
                'image_url' =>  $creativeData->image_url,
                'msg' => "Your image has been declined by administrator. Please find the attached images below"
              ];
              try {
                  
                  Mail::to($userData['email'])->send(new publishImageDecline($userData));
              } catch (\Exception $e) {
              }
        }

        if ($userData) {
            return response()->json([
            'status' => 'success',
            'data' => $userData,
            'message' => 'Image Declined!'
            ]);
        }else{
            return response()->json([
            'status' => 'failure',
            'message' => 'Something went wrong!'
            ]);
        }
    }

    public function privateImage(Request $request){
        $creativeData = DB::table('creativehistory')->where('id', $request->id)->first();

        $data = DB::table('creativehistory')->where('id', $request->id)->update([
            'is_published' => 'false',
            'is_reviewed' => null,
        ]);

        $userData = User::where('id',$creativeData->user_id)->first();

        if($userData){
            $userData = [
                'admin' => false,
                'firstname' => $userData->first_name,
                'lastname' => $userData->lastname,
                'email' => $userData->email,
                'subject' => 'Exdiffusion Image Declined',
                'image_url' =>  $creativeData->image_url,
                'msg' => "Your image has been private by administrator. Please find the attached images below"
              ];
              try {
                  
                //   Mail::to($userData['email'])->send(new publishImageDecline($userData));
              } catch (\Exception $e) {
              }
        }

        if ($userData) {
            return response()->json([
            'status' => 'success',
            'data' => $userData,
            'message' => 'Image Private Successfully!'
            ]);
        }else{
            return response()->json([
            'status' => 'failure',
            'message' => 'Something went wrong!'
            ]);
        }
    }

    public function updateImage(Request $request){
        $creativeData = DB::table('creativehistory')->where('id', $request->id)->first();

        $data = DB::table('creativehistory')->where('id', $request->id)->update([
            'is_nsfw_image' => $request->is_nsfw,
        ]);

        $userData = User::where('id',$creativeData->user_id)->first();

       

        if ($userData) {
            return response()->json([
            'status' => 'success',
            'data' => $userData,
            'message' => 'Image Private Successfully!'
            ]);
        }else{
            return response()->json([
            'status' => 'failure',
            'message' => 'Something went wrong!'
            ]);
        }
    }

    public function searchImages(Request $request){

        if($request->searchType == 'Reviewed'){
            $data = DB::table('creativehistory')->where('is_published', 'true')->where('selectedBaseModelText', 'like', '%' . $request->keyword . '%')->whereIn('is_reviewed', ['true'])->get();
        }if($request->searchType == 'UnReviewed'){
            $data = DB::table('creativehistory')->where('is_published', 'true')->where('selectedBaseModelText', 'like', '%' . $request->keyword . '%')->whereIn('is_reviewed', ['false','declined'])->get();
        }
        
        if ($data) {
            return response()->json([
              'status' => 'success',
              'data' => $data,
              'message' => 'Images Found base on search!'
            ]);
        }else{
            return response()->json([
              'status' => 'failure',
              'message' => 'Something went wrong!'
            ]);
        }
    }

    
}
