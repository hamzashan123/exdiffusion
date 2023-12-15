<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublishCreationController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    
    public function myAsset(){
        return view('frontend.exdiffusion.creativeHistory');
    }

    public function imageDetail(int $id){
      
        $user = Auth::user();
        $data = DB::table('creativehistory')->where('id',$id)->first();
        
        if(!empty($data)){
            return view('frontend.exdiffusion.imageDetails',['data' => $data]);
        }else{

            abort(404);

        }
       
    }

    public function deleteImageDetail(Request $request){
        $user = Auth::user();
        $data = DB::table('creativehistory')->where('id',$request->creativeId)->delete();

        if(!empty($data)){
        
            return response()->json([
              'status' => 'success',
              'data' => $data,
              'message' => 'Image Successfully Deleted!'
            ]);
    
          }else{
    
            return response()->json([
              'status' => 'failure',
              'message' => 'Something went wrong!'
            ]);
    
          }
    }
}
