<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\publishImageRequest;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PublicModelsController extends Controller
{

  protected $imagesLimit = 20;

  public function getBaseModels(Request $request)
  {

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


    if ($e = curl_error($curl)) {
      echo $e;
    } else {

      // Decoding JSON data
      $user = Auth::user();
      $decodedData = json_decode($response, true);

      
      // These three checks are for those api result which return array of models we are merging one column of image from our database table for showing images. 

      if(count($decodedData['models']) > 0 ){
        
        
        foreach($decodedData['models'] as $key => $value){

         

          // bad ma delete krdenge 
          if(isset($user) && $user->email == 'faizythebest95@gmail.com'){
            $modelData = DB::table('creativehistory')->where('is_nsfw_image','!=','true')->where('selectedBaseModelText', $value['model_id'])->inRandomOrder()->take(1)->get();

          }else{
            $modelData = DB::table('creativehistory')->where('selectedBaseModelText', $value['model_id'])->inRandomOrder()->take(1)->get();
          }

          if(count($modelData) > 0){
            if($modelData[0]->selectedBaseModelText == $value['model_id']){
              // dd($value['model_id']);
              $decodedData['models'][$key]['image_url'] = $modelData[0]->image_url;

            }
          }else{
            $decodedData['models'][$key]['image_url'] = null;
          }
        }

      }
      // dd( $decodedData['models']);
      

      if(count($decodedData['lora_models']) > 0 ){
       
        foreach($decodedData['lora_models'] as $key => $value){

          
          
          // bad ma delete krdenge 
          if(isset($user) && $user->email == 'faizythebest95@gmail.com'){
            $modelData = DB::table('creativehistory')->where('is_nsfw_image','!=','true')->where('loraModelArray', $value['model_id'])->inRandomOrder()->take(1)->get();
          }else{
            $modelData = DB::table('creativehistory')->where('loraModelArray', $value['model_id'])->inRandomOrder()->take(1)->get();
          }

          if(count($modelData) > 0){
            if($modelData[0]->loraModelArray == $value['model_id']){
              // dd($value['model_id']);
              $decodedData['lora_models'][$key]['image_url'] = $modelData[0]->image_url;
            }
          }else{
            $decodedData['lora_models'][$key]['image_url'] = null;
          }
        }
      }

      
      if(count($decodedData['embeddings_models']) > 0 ){
       
        foreach($decodedData['embeddings_models'] as $key => $value){

          
          
          // bad ma delete krdenge 
          if(isset($user) && $user->email == 'faizythebest95@gmail.com'){
            $modelData = DB::table('creativehistory')->where('is_nsfw_image','!=','true')->where('embeddingModelArray', $value['model_id'])->inRandomOrder()->take(1)->get();
          
          }else{
            $modelData = DB::table('creativehistory')->where('embeddingModelArray', $value['model_id'])->inRandomOrder()->take(1)->get();
          }

          if(count($modelData) > 0){
            if($modelData[0]->embeddingModelArray == $value['model_id']){
              // dd($value['model_id']);
              $decodedData['embeddings_models'][$key]['image_url'] = $modelData[0]->image_url;
            }
          }else{
            $decodedData['embeddings_models'][$key]['image_url'] = null;
          }
        }
      }

      
      echo json_encode($decodedData);
    }

    

    // Closing curl
    curl_close($curl);
  }



  public function getSchedulers(Request $request)
  {
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


    if ($e = curl_error($curl)) {
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


  public function creativeHistory(Request $request)
  {
    
    $imagesUrl = explode(",", $request->images);
    $dataArray = [];


    if (!empty($imagesUrl)) {
      foreach ($imagesUrl as $key => $url) {
        // Generate a unique filename for each image

        // Save the image to the storage
        $storagePath = 'public/creativehistory'; // Adjust this path as needed
        $client = new Client();
        $response = $client->get($url);
        $extension = pathinfo($url, PATHINFO_EXTENSION); // Get the file extension from the URL
        // Generate a unique filename (you can use a custom logic if needed)
        $filename = auth()->user()->id . '-' . uniqid() . '.' . $extension;
        // Store the image in your storage directory
        Storage::disk($storagePath)->put($filename, $response->getBody());

        $localFileLink = url('/') . '/storage/images/creativehistory/' . $filename;
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
          'highres_fix' => $request->highres_fix,
          'upscale' => $request->upscale,
          'tomesd' => $request->tomesd,
          'karras_sigmas' => $request->karras_sigmas,
          'image_url' => $localFileLink,
          'loraModelArray' => $request->loraModelArray,
          'loraModelStrength' => $request->loraModelStrength,
          'embeddingModelArray' => $request->embeddingModelArray,
          'is_nsfw_image' => 'false'
        ]);

        //check if content is adult or not
        $nsfwCheck = $this->nsfwImageCheck($localFileLink);
        if ($nsfwCheck == true) {
          DB::table('creativehistory')->where('id', $Id)->update([
            'is_nsfw_image' => 'true'
          ]);
        }

        array_push($dataArray,  $Id);
      }
      return response()->json([
        'status' => 'success',
        'data' => $dataArray,
        'message' => 'Data saved!'
      ]);
    } else {
      return response()->json([
        'status' => 'failure',
        'message' => 'Something went wrong!'
      ]);
    }
  }

  function nsfwImageCheck(string $imageUrl)
  {
    if ($imageUrl != null) {
      $payload = [
        "key" => "rfhpc3j1c7kw0t",
        "init_image" => $imageUrl
        // "init_image" => "https://pub-3626123a908346a7a8be8d9295f44e26.r2.dev/temp/0-bdf3536a-cf63-4245-98e2-9c910a74fcc7.png"
      ];
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://stablediffusionapi.com/api/v1/enterprise/nsfw_image_check',
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
      if ($e = curl_error($curl)) {
        return "false";
      } else {

        $decodedData = json_decode($response, true);
        if (isset($decodedData['has_nsfw_concept'])) {
          return $decodedData['has_nsfw_concept'][0];
        } else {
          return "false";
        }
      }
    } else {
      return "false";
    }
  }
  public function publishCreation()
  {
    return view('frontend.exdiffusion.publishedCreation');
  }

  public function getUserCreativeHistory(Request $request)
  {
    $user = Auth::user();
    $totalRecords = 0;
    if ($user) {

      $userCreativeHistory = DB::table('creativehistory')->where('user_id', $user->id);
      
      if ($request->modelType == 'creativeHistory') {
        $userCreativeHistory =  $userCreativeHistory;
        $totalRecords = $userCreativeHistory->count();
      } elseif ($request->modelType == 'Images') {
        $userCreativeHistory =  $userCreativeHistory->where('is_favorite', 'true');
        $totalRecords = $userCreativeHistory->count();
      } elseif ($request->modelType == 'Base_Models') {
        $userCreativeHistory =  $userCreativeHistory;
        $totalRecords = $userCreativeHistory->count();
      } elseif ($request->modelType == 'Lora_Models') {
        $userCreativeHistory =  $userCreativeHistory->where('loraModelArray', '!=', null);
        $totalRecords = $userCreativeHistory->count();
      } elseif ($request->modelType == 'Embedding_Models') {
        $userCreativeHistory =  $userCreativeHistory->where('embeddingModelArray', '!=', null);
        $totalRecords = $userCreativeHistory->count();
      }else{
        $userCreativeHistory =  $userCreativeHistory;
        $totalRecords = $userCreativeHistory->count();
      }

      
      if(isset($request->last_id) && $request->last_id != null){
        $userCreativeHistory = $userCreativeHistory->where('id', '>', $request->last_id);
      }
      $userCreativeHistory = $userCreativeHistory->limit($this->imagesLimit)->get(); 

      if(count($userCreativeHistory) > 0){
        $lastRecord = $userCreativeHistory->last()->id;
      }else{
        $lastRecord = null;
      }

      // dd($totalRecords);
      if ($userCreativeHistory != null) {
        return response()->json([
          'status' => 'success',
          'totalRecords' => $totalRecords,
          'data' => $userCreativeHistory,
          'last_id' => $lastRecord,
          'message' => 'Data found!'
        ]);
      } else {
        return response()->json([
          'status' => 'failure',
          'message' => 'Something went wrong!'
        ]);
      }
    }
  }

  public function getPublishCreation(Request $request)
  {
    
    $user = Auth::user();
    $totalRecords = 0;
    $userCreativeHistory = DB::table('creativehistory')->where('is_published', 'true')->where('is_reviewed', 'true');
    if ($request->modelType == 'Images') {

        $userCreativeHistory = $userCreativeHistory->where('is_nsfw_image', '!=', 'true');
        $totalRecords = $userCreativeHistory->count();
        if(isset($request->last_id) && $request->last_id != null){
            $userCreativeHistory = $userCreativeHistory->where('id', '>', $request->last_id);
        }
        $userCreativeHistory = $userCreativeHistory->limit($this->imagesLimit)->get();  

    } else if ($request->modelType == 'NSFW') {

      $userCreativeHistory = DB::table('creativehistory')->where('is_published', 'true')->where('is_reviewed', 'true')->where('is_nsfw_image', 'true');
      $totalRecords = $userCreativeHistory->count();
      if(isset($request->last_id) && $request->last_id != null){
          $userCreativeHistory = $userCreativeHistory->where('id', '>', $request->last_id);
      }
      $userCreativeHistory = $userCreativeHistory->limit($this->imagesLimit)->get();    

    } else if ($request->modelType == 'Favourite') {

      $userCreativeHistory = DB::table('creativehistory')
        ->join('publishedcreation_favorites', 'creativehistory.id', '=', 'publishedcreation_favorites.creative_id')
        ->where('publishedcreation_favorites.is_publishedcreation_favorite', '=', 'true')
        ->where('publishedcreation_favorites.user_id', '=', $user->id)
        ->select('creativehistory.*', 'publishedcreation_favorites.is_publishedcreation_favorite as is_publishedcreation_favorite');

      $totalRecords = $userCreativeHistory->count();

      if(isset($request->last_id) && $request->last_id != null){
          $userCreativeHistory = $userCreativeHistory->where('creativehistory.id', '>', $request->last_id);
      }
      $userCreativeHistory = $userCreativeHistory->limit($this->imagesLimit)->get();

    } else {
      $totalRecords = $userCreativeHistory->where('is_nsfw_image', '!=', 'true')->count();
      $userCreativeHistory = $userCreativeHistory
        ->where('is_nsfw_image', '!=', 'true')
        ->limit($this->imagesLimit)->get();
    }

    if(count($userCreativeHistory) > 0){
      $lastRecord = $userCreativeHistory->last()->id;
    }else{
      $lastRecord = null;
    }
    
  
    if ($userCreativeHistory != null) {
      return response()->json([
        'status' => 'success',
        'totalRecords' => $totalRecords,
        'data' => $userCreativeHistory,
        'last_id' => $lastRecord,
        'message' => 'Data found!'
      ]);
    } else {
      return response()->json([
        'status' => 'failure',
        'message' => 'Something went wrong!'
      ]);
    }
  }

  public function publishImages(Request $request)
  {

    $user = Auth::user();
    $image_links = [];
    if ($user) {
      foreach ($request->generatedImageResponse['data'] as $id) {
        $is_published = DB::table('creativehistory')->where('user_id', $user->id)->where('id', $id)->update([
          'is_published' => "true",
          'is_reviewed' => 'false'
        ]);

        if(!empty($id) && !empty($user->id)){
          $image = DB::table('creativehistory')->where('user_id', $user->id)->where('id', $id)->first();
          array_push($image_links,$image->image_url);
        }
        
      }


      $adminData = [
        'admin' => true,
        'firstname' => $user->first_name,
        'lastname' => $user->lastname,
        'email' => $user->email,
        'subject' => 'Exdiffusion Image Approval',
        'image_links' => $image_links,
        'msg' => "". strtoupper($user->first_name)." has requested to Published the Images. Please login to  <a href='" . route('admin.login') . "'>Admin Panel</a> to review images."
      ];


      try {
          $adminemail = User::role('admin')->first();
          Mail::to($adminemail)->send(new publishImageRequest($adminData));
      } catch (\Exception $e) {
      }

      return response()->json([
        'status' => 'success',
        'message' => 'Published request has been sent to administrator'
      ]);
    } else {

      return response()->json([
        'status' => 'failure',
        'message' => 'Something went wrong!'
      ]);
    }
  }

  public function publishSingleImage(Request $request)
  {
    $user = Auth::user();
    $image_links = [];
    if ($user) {

      $is_published = DB::table('creativehistory')->where('id', $request->creativeId)->update([
        'is_published' => "true",
        'is_reviewed' => 'false'
      ]);

      if(!empty($user->id)){
        $image = DB::table('creativehistory')->where('id', $request->creativeId)->first();
        array_push($image_links,$image->image_url);
      }

      $adminData = [
        'admin' => true,
        'firstname' => $user->first_name,
        'lastname' => $user->lastname,
        'email' => $user->email,
        'image_links' => $image_links,
        'subject' => 'Exdiffusion Image Approval',
        'msg' => "". strtoupper($user->first_name)." has requested to Published the Images. Please login to  <a href='" . route('admin.login') . "'>Admin Panel</a> to review images."
      ];


      try {
          $adminemail = User::role('admin')->first();
          Mail::to($adminemail)->send(new publishImageRequest($adminData));
      } catch (\Exception $e) {
      }
      
      return response()->json([
        'status' => 'success',
        'message' => 'Published request has been sent to administrator.'
      ]);
    } else {

      return response()->json([
        'status' => 'failure',
        'message' => 'Something went wrong!'
      ]);
    }
  }

  public function privateSingleImage(Request $request)
  {
    $user = Auth::user();
    if ($user) {

      $is_published = DB::table('creativehistory')->where('id', $request->creativeId)->update([
        'is_published' => "false",
        'is_reviewed' => 'false'
      ]);

      return response()->json([
        'status' => 'success',
        'message' => 'Your image has been set to private.'
      ]);
    } else {

      return response()->json([
        'status' => 'failure',
        'message' => 'Something went wrong!'
      ]);
    }
  }

  public function deleteUserCreativeHistory(Request $request)
  {
    $user = Auth::user();

    if (!empty($request->creativeArray)) {

      foreach ($request->creativeArray as $creativeId) {
        DB::table('creativehistory')->where('user_id', $user->id)->where('id', $creativeId)->delete();
      }

      return response()->json([
        'status' => 'success',
        'message' => 'Creative history deleted!'
      ]);
    } else {

      return response()->json([
        'status' => 'failure',
        'message' => 'Something went wrong!'
      ]);
    }
  }

  public function addToFavoriteCreativeHistory(Request $request)
  {
    $user = Auth::user();
    if (!empty($request->creativeArray)) {

      if ($request->publishcreation == true) {
        foreach ($request->creativeArray as $creativeId) {
          $recordExists = DB::table('publishedcreation_favorites')->where('user_id', $user->id)->where('creative_id', $creativeId)->where('is_publishedcreation_favorite', 'true')->exists();

          if ($recordExists == false) {
            DB::table('publishedcreation_favorites')->insertGetId([
              'user_id' => $user->id,
              'creative_id' => $creativeId,
              'is_publishedcreation_favorite' => 'true',
            ]);
          }
        }
      } else {
        foreach ($request->creativeArray as $creativeId) {
          DB::table('creativehistory')->where('user_id', $user->id)->where('id', $creativeId)
            ->update([
              'is_favorite' => 'true',
            ]);
        }
      }

      return response()->json([
        'status' => 'success',
        'message' => 'Added to favorites list!'
      ]);
    } else {

      return response()->json([
        'status' => 'failure',
        'message' => 'Something went wrong!'
      ]);
    }
  }

  public function getGeneratedImageHistory(Request $request)
  {
    $user = Auth::user();
    $generatedHistory = DB::table('creativehistory')->where('id', $request->creativeId)->first();

    if (!empty($generatedHistory)) {

      return response()->json([
        'status' => 'success',
        'data' => $generatedHistory,
        'message' => 'Data Found!'
      ]);
    } else {

      return response()->json([
        'status' => 'failure',
        'message' => 'Something went wrong!'
      ]);
    }
  }
}
