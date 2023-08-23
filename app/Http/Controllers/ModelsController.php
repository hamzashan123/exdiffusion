<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModelsController extends Controller
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


    public function generateImages(Request $request){
      
      
      

      if($request->lora_model != null){
        $lora_models = implode(',', $request->lora_model);
      }else{
        $lora_models = null;
      } 

      if($request->embeddings_model != null){
        $embedding_models = implode(',', $request->embeddings_model);
      }else{
        $embedding_models = null;
      } 




      $safety_checker = ($request->safety_checker === true) ? 'yes' : 'no';
      $enhance_prompt = ($request->enhance_prompt === true) ? 'yes' : 'no';
      $multi_lingual = ($request->multi_lingual === true) ? 'yes' : 'no';
      $panorama = ($request->panorama === true) ? 'yes' : 'no';
      $self_attention = ($request->self_attention === true) ? 'yes' : 'no';
      $upscale = ($request->upscale === true) ? 'yes' : 'no';
      $tomesd = ($request->tomesd === true) ? 'yes' : 'no';
      $karras_sigmas = ($request->karras_sigmas === true) ? 'yes' : 'no';

      if($request->seed == -1 || $request->seed == null){
          $seedValue = null;
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
        "seed" => isset($seedValue) ? $seedValue: -1, 
        "guidance_scale" => isset($request->guidance_scale) ? $request->guidance_scale: 7.5, 
        "multi_lingual" => $multi_lingual, 
        "panorama" => $panorama, 
        "self_attention" => $self_attention, 
        "upscale" => $upscale, 
        "embeddings_model" => $embedding_models, 
        "lora_model" => $lora_models,
        "tomesd" => $tomesd,
        "use_karras_sigmas" => $karras_sigmas,
        "vae" => null,
        "lora_strength" => null,
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

        $payload = [
          "key" => "rfhpc3j1c7kw0t", 
          "url" => "https://pub-8b49af329fae499aa563997f5d4068a4.r2.dev/generations/e5cd86d3-7305-47fc-82c1-7d1a3b130fa4-0.png", 
          "scale" => 3, 
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
