<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModelsController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function test(){
          $url = 'https://pub-3626123a908346a7a8be8d9295f44e26.r2.dev/temp/0-75128644-4aa0-418f-a35f-42d541983eed.png';   
          // Save the image to the storage
          $storagePath = 'public/creativehistory'; // Adjust this path as needed
          $client = new Client();
          $response = $client->get($url);
          $extension = pathinfo($url, PATHINFO_EXTENSION); // Get the file extension from the URL
          // Generate a unique filename (you can use a custom logic if needed)
          $filename = auth()->user()->id.'-'.uniqid() . '.' . $extension;
          // Store the image in your storage directory
          Storage::disk($storagePath)->put($filename, $response->getBody());
                    dd($extension);
    }

    public function index(){
        return view('frontend.exdiffusion.playground');
    }

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


    public function generateImages(Request $request){
      
    
      if($request->lora_model != null){
        $lora_models = implode(',', $request->lora_model);
      }else{
        $lora_models = null;
      } 

      if($request->lora_strength != null){
        $lora_strength = implode(',', $request->lora_strength);
      }else{
        $lora_strength = null;
      } 


      if($request->embeddings_model != null){
        $embedding_models = implode(',', $request->embeddings_model);
      }else{
        $embedding_models = null;
      } 


      
      $safety_checker = ($request->safety_checker == "true") ? 'yes' : 'no';
      $enhance_prompt = ($request->enhance_prompt == "true") ? 'yes' : 'no';
      $multi_lingual = ($request->multi_lingual == "true") ? 'yes' : 'no';
      $panorama = ($request->panorama == "true") ? 'yes' : 'no';
      $self_attention = ($request->self_attention == "true") ? 'yes' : 'no';
      $highres_fix = ($request->highres_fix == "true") ? 'yes' : 'no';
      $upscale = ($request->upscale == "true") ? 'yes' : 'no';
      $tomesd = ($request->tomesd == "true") ? 'yes' : 'no';
      $karras_sigmas = ($request->karras_sigmas == "true") ? 'yes' : 'no';

      

      if($request->seed == "-1" || $request->seed == null){
          $seedValue = null;
      }else{
        $seedValue = $request->seed;
      }

      

      $payload = [
        "key" => "rfhpc3j1c7kw0t", 
        "model_id" => $request->model_id, 
        "prompt" => $request->prompt,
        "negative_prompt" => $request->negative_prompt, 
        "width" => isset($request->width) ? $request->width: 512, 
        "height" => isset($request->height) ? $request->height: 768, 
        "samples" => isset($request->samples) ? $request->samples: 1,
        "num_inference_steps" => isset($request->num_inference_steps) ? $request->num_inference_steps: 30, 
        "safety_checker" => $safety_checker, 
        "enhance_prompt" => $enhance_prompt, 
        "seed" => isset($seedValue) ? $seedValue: null, 
        "guidance_scale" => isset($request->guidance_scale) ? $request->guidance_scale: 7.5, 
        "multi_lingual" => $multi_lingual, 
        "panorama" => $panorama, 
        "self_attention" => $self_attention, 
        "highres_fix" => $highres_fix,
        "upscale" => $upscale, 
        "embeddings_model" => $embedding_models, 
        "lora_model" => $lora_models,
        "tomesd" => $tomesd,
        "use_karras_sigmas" => $karras_sigmas,
        "vae" => isset($request->vae) ? $request->vae: null,
        "lora_strength" => $lora_strength,
        "scheduler" => isset($request->scheduler) ? $request->scheduler: null,
        "clip_skip" => isset($request->clip_skip) ? $request->clip_skip: null,
        "webhook" => null, 
        "track_id" => null 
      ];

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://stablediffusionapi.com/api/v1/enterprise/text2img',
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

    public function getSuperResolutionImage(Request $request){
        
        if($request->has('image_url') && $request->creativeHistoryId != null){
          $imageUrl = $request->image_url;
        }else{
          $imageData = $request->file('file');
          $imageName = time() . '.' . $imageData->getClientOriginalExtension();
          $imageData->storeAs('public/images/creativehistory', $imageName);
          $imageLink = Storage::url('public/images/creativehistory/' . $imageName);
          $imageUrl = url('/').$imageLink;
        }
        
        // // Your URL and storage path
        // $url = $imageUrl;
        // $storagePath = 'public/creativehistory'; // Adjust this path as needed
        // $client = new Client();
        // $response = $client->get($url);
        // $extension = pathinfo($url, PATHINFO_EXTENSION); // Get the file extension from the URL
        // // Generate a unique filename (you can use a custom logic if needed)
        // $filename = uniqid() . '.' . $extension;
        // // Store the image in your storage directory
        // Storage::disk($storagePath)->put($filename, $response->getBody());
        // dd($filename);
        
        $payload = [
          "key" => "rfhpc3j1c7kw0t",
          "model_id" => isset($request->super_resultion_model_id) ? $request->super_resultion_model_id: "realesr-general-x4v3", 
          "url" => $imageUrl, 
          "scale" => isset($request->superscale_input) ? $request->superscale_input: 3, 
          "webhook" => null, 
          "face_enhance" => true 
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://stablediffusionapi.com/api/v1/enterprise/super_resolution',
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
        curl_close($curl);
        $response = json_decode($response,true); 
        
            if(!empty($response)){
              $url = $response['output'][0];
               // // Your URL and storage path
              $storagePath = 'public/creativehistory'; // Adjust this path as needed
              $client = new Client();
              $imgResponse = $client->get($url);
              $extension = pathinfo($url, PATHINFO_EXTENSION); // Get the file extension from the URL
              // Generate a unique filename (you can use a custom logic if needed)
              $filename = auth()->user()->id.'-'.uniqid() . '.' . $extension;
              // Store the image in your storage directory
              Storage::disk($storagePath)->put($filename, $imgResponse->getBody());
              // dd($filename);
              
              if($request->creativeHistoryId != "undefined"){
                
                $creativeData = DB::table('creativehistory')->where('id',$request->creativeHistoryId)->first();
                  $Id  = DB::table('creativehistory')->insertGetId([
                        'user_id' => auth()->user()->id,
                        'selectedBaseModelText' => $creativeData->selectedBaseModelText,
                        'vaemodelslist' => $creativeData->vaemodelslist,
                        'prompt' => $creativeData->prompt,
                        'neg_prompt' => $creativeData->neg_prompt,
                        'scheduler_list' => $creativeData->scheduler_list,
                        'seed' => $creativeData->seed,
                        'interference_input' => $creativeData->interference_input,
                        'clickskip_input' => $creativeData->clickskip_input,
                        'width_input' => $creativeData->width_input,
                        'samples_input' => $creativeData->samples_input,
                        'height_input' => $creativeData->height_input,
                        'guidance_input' => $creativeData->guidance_input,
                        'safety_checker' => $creativeData->safety_checker,
                        'enhance_prompt' => $creativeData->enhance_prompt,
                        'multi_lingual' => $creativeData->multi_lingual,
                        'panorama' => $creativeData->panorama,
                        'self_attention' => $creativeData->self_attention,
                        'highres_fix' => $creativeData->highres_fix,
                        'upscale' => $creativeData->upscale,
                        'tomesd' => $creativeData->tomesd,
                        'karras_sigmas' => $creativeData->karras_sigmas,
                        'image_url' => null,
                        'loraModelArray' => $creativeData->loraModelArray,
                        'loraModelStrength' => $creativeData->loraModelStrength,
                        'embeddingModelArray' => $creativeData->embeddingModelArray,
                        // super resolution data
                        'image_url_super_resolution' => url('/').'/storage/images/creativehistory/'.$filename,
                        'is_super_resolution' => 'true',
                        'super_resolution_model_id' => isset($request->super_resultion_model_id) ? $request->super_resultion_model_id: "realesr-general-x4v3",
                        'superscale_input' => isset($request->superscale_input) ? $request->superscale_input: 3,
                        'super_resolution_face_enhance' => 'true'
                    ]);
                  return response()->json([
                    'status' => 'success',
                    'data' => $response,
                    'superResolutionId' => $Id
                  ]);

              }else{
                  // save only upload image data with other fields as blank
                  $Id  = DB::table('creativehistory')->insertGetId([
                          'user_id' => auth()->user()->id,
                          'image_url_super_resolution' => url('/').'/storage/images/creativehistory/'.$filename,
                          'is_super_resolution' => 'true',
                          'super_resolution_model_id' => isset($request->super_resultion_model_id) ? $request->super_resultion_model_id: "realesr-general-x4v3",
                          'superscale_input' => isset($request->superscale_input) ? $request->superscale_input: 3,
                          'super_resolution_face_enhance' => 'true'
                  ]);

                  return response()->json([
                    'status' => 'success',
                    'data' => $response,
                    'superResolutionId' => $Id
                  ]);
              }
              
          }
        
       

      

      
    } 

    
    public function uploadModels(Request $request){
      $payload = [
        "key" => "rfhpc3j1c7kw0t",
        "url" => $request->url,
        "model_id" => $request->model_id,
        "model_type" => $request->model_type,
        "from_safetensors" => $request->from_safetensors,
        "webhook" => "https://stablediffusionapi.com",
        "revision" => $request->revision,
        "upcast_attention" => $request->upcast_attention
      ];
      
      // dd($payload);

      $curl = curl_init();
      
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://stablediffusionapi.com/api/v1/enterprise/load_model',
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
      
      curl_close($curl);
      echo $response;
    }

    public function restartServer(){
      $payload = [
        "key" => "rfhpc3j1c7kw0t"
      ];
      
      $curl = curl_init();
      
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://stablediffusionapi.com/api/v1/enterprise/restart_server',
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
      
      curl_close($curl);
      echo $response;
    }
}
