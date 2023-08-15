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
}
