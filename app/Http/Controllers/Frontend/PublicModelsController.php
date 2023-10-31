<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PublicModelsController extends Controller
{
  
  public function getBaseModels(Request $request){

        $payload = [
          "key" => "rfhpc3j1c7kw0t", 
        ];
       
        $curl = curl_init();
      
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://stablediffusionapi.com/api/v1/enterprise/get_all_models',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($payload),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
      
      
        if($e = curl_error($curl)) {
            echo $e;
        } else {
            
            // Decoding JSON data
            
            $decodedData =
                json_decode($response, true);
                
            // Outputting JSON data in
            // Decoded form
            
            echo json_encode($decodedData);
          
        }
       
        // Closing curl
        curl_close($curl);
  }

  public function getSchedulers(Request $request){
      $payload = [
        "key" => "rfhpc3j1c7kw0t"
      ];
      
      $curl = curl_init();
      
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://stablediffusionapi.com/api/v1/enterprise/schedulers_list',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
      ));
      
      $response = curl_exec($curl);
      
      
      if($e = curl_error($curl)) {
          echo $e;
      } else {
          
          // Decoding JSON data
          
          $decodedData =
              json_decode($response, true);
              
          // Outputting JSON data in
          // Decoded form
          
          echo json_encode($decodedData);
        
      }
     
      // Closing curl
      curl_close($curl);
  }


  public function creativeHistory(Request $request){
      $imagesUrl = explode(",", $request->images); 
      $dataArray = [];
      // Specify the folder in your storage where you want to save the images
      $storageFolder = 'public/images/creativehistory';

      if(!empty($imagesUrl)){
        foreach ($imagesUrl as $key => $url) {
            // Generate a unique filename for each image
            $filename = auth()->user()->id.'-'.uniqid();
            // Save the image to the storage
            Storage::put("$storageFolder/$filename", file_get_contents($url));
          
            // You can use the $filename variable to store the file path in your database or perform other operations.
            $Id  = DB::table('creativehistory')->insertGetId([
                'user_id' => auth()->user()->id,
                'selectedBaseModelText' => $request->selectedBaseModelText,
                'vaemodelslist' => $request->vaemodelslist,
                'prompt' => $request->prompt,
                'neg_prompt' => $request->neg_prompt,
                'scheduler_list' => $request->scheduler_list,
                'seed' => $request->seed,
                'interference_input' => $request->interference_input,
                'clickskip_input' => $request->clickskip_input,
                'width_input' => $request->width_input,
                'samples_input' => $request->samples_input,
                'height_input' => $request->height_input,
                'guidance_input' => $request->guidance_input,
                'safety_checker' => $request->safety_checker,
                'enhance_prompt' => $request->enhance_prompt,
                'multi_lingual' => $request->multi_lingual,
                'panorama' => $request->panorama,
                'self_attention' => $request->self_attention,
                'upscale' => $request->upscale,
                'tomesd' => $request->tomesd,
                'karras_sigmas' => $request->karras_sigmas,
                'image_url' => url('/').'/storage/images/creativehistory/'.$filename,
                'loraModelArray' => $request->loraModelArray,
                'loraModelStrength' => $request->loraModelStrength,
                'embeddingModelArray' => $request->embeddingModelArray
                
            ]);
            array_push($dataArray,  $Id);
        }
          return response()->json([
            'status' => 'success',
            'data' => $dataArray,
            'message' => 'Data saved!'
          ]);
      }else{
          return response()->json([
            'status' => 'failure',
            'message' => 'Something went wrong!'
          ]);
      }
      
  }

  public function getUserCreativeHistory(Request $request){
    $user = Auth::user();
    if($user){

      $userCreativeHistory = DB::table('creativehistory')->where('user_id',$user->id);
      if($request->modelType == 'creativeHistory'){
        $userCreativeHistory =  $userCreativeHistory;
      }elseif($request->modelType == 'Images'){
        $userCreativeHistory =  $userCreativeHistory->where('is_favorite','true');
      }
      elseif($request->modelType == 'Base_Models'){
        $userCreativeHistory =  $userCreativeHistory;
      }
      elseif($request->modelType == 'Lora_Models'){
        $userCreativeHistory =  $userCreativeHistory->where('loraModelArray','!=',null);
      }
      elseif($request->modelType == 'Embedding_Models'){
        $userCreativeHistory =  $userCreativeHistory->where('embeddingModelArray','!=',null);
      }

      $userCreativeHistory = $userCreativeHistory->get();
      return response()->json([
        'status' => 'success',
        'data' => $userCreativeHistory,
        'message' => 'Data found!'
      ]);

    }else{

      return response()->json([
        'status' => 'failure',
        'message' => 'Something went wrong!'
      ]);

    }

  }

  public function getPublishCreation(Request $request){
      $user = Auth::user();
      if($user){

        $userCreativeHistory = DB::table('creativehistory');
        if($request->modelType == 'Images'){
          $userCreativeHistory =  $userCreativeHistory;
        }elseif($request->modelType == 'Favourite'){
          $userCreativeHistory =  $userCreativeHistory->where('is_publishcreation_favorite','true');
        }
        $userCreativeHistory = $userCreativeHistory->get();
        return response()->json([
          'status' => 'success',
          'data' => $userCreativeHistory,
          'message' => 'Data found!'
        ]);

      }else{

        return response()->json([
          'status' => 'failure',
          'message' => 'Something went wrong!'
        ]);

      }
  }

  public function publishImages(Request $request){
    
    $user = Auth::user();
      if($user){
        foreach($request->generatedImageResponse['data'] as $id){
          $is_published = DB::table('creativehistory')->where('user_id',$user->id)->where('id',$id)->update([
            'is_published' => "true"
          ]);
        }
        return response()->json([
          'status' => 'success',
          'message' => 'Published Successfully'
        ]);

      }else{

        return response()->json([
          'status' => 'failure',
          'message' => 'Something went wrong!'
        ]);

      }
  }

  public function deleteUserCreativeHistory(Request $request){
      $user = Auth::user();
      
      if(!empty($request->creativeArray)){

        foreach($request->creativeArray as $creativeId){
          DB::table('creativehistory')->where('user_id',$user->id)->where('id',$creativeId)->delete();
        }
        
        return response()->json([
          'status' => 'success',
          'message' => 'Creative history deleted!'
        ]);

      }else{

        return response()->json([
          'status' => 'failure',
          'message' => 'Something went wrong!'
        ]);

      }
  }

  public function addToFavoriteCreativeHistory(Request $request){
      $user = Auth::user();
      if(!empty($request->creativeArray)){

        if($request->publishcreation == true){
          foreach($request->creativeArray as $creativeId){
            DB::table('creativehistory')->where('user_id',$user->id)->where('id',$creativeId)
            ->update([
              'is_publishcreation_favorite' => 'true',
            ]);
          }
        }else{
          foreach($request->creativeArray as $creativeId){
            DB::table('creativehistory')->where('user_id',$user->id)->where('id',$creativeId)
            ->update([
              'is_favorite' => 'true',
            ]);
          }
        }
       
        return response()->json([
          'status' => 'success',
          'message' => 'Added to favorites list!'
        ]);

      }else{

        return response()->json([
          'status' => 'failure',
          'message' => 'Something went wrong!'
        ]);

      }
  }

  public function getGeneratedImageHistory(Request $request){
      $user = Auth::user();
      $generatedHistory = DB::table('creativehistory')->where('id',$request->creativeId)->first();
      
      if(!empty($generatedHistory)){
        
        return response()->json([
          'status' => 'success',
          'data' => $generatedHistory,
          'message' => 'Data Found!'
        ]);

      }else{

        return response()->json([
          'status' => 'failure',
          'message' => 'Something went wrong!'
        ]);

      }
  }

}
