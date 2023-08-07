@extends('layouts.app')

@section('content')
    <br>
    <div class="playgroundMain">
    
        <div class="modelsListings input-group ">
            
                    <div class="col-md-3">
                        
                        <label for="" class="text-white">  &nbsp;  Base Model</label>
                        <div class="input-group">
                        <input type="text" class="form-control dark-grey border-radius-7 " value="Realistic Vision V1.3">
                        <div class="input-group-append">
                            <button class="" type="button">+</button>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-3 mx-3">
                    <label for="" class="text-white">   &nbsp;  VAE</label>
                        <select name="" id="" class="form-control dark-grey border-radius-7">
                            <option value="" selected>None</option>
                            <option value="img2img">vae-hopital-real2</option>
                            <option value="img2img">vae-fogaminsk</option>
                        </select>
                    </div>
               
        </div>
           <br> 
        <div class="tabSections">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-light-grey active" id="txt2img-tab" data-bs-toggle="tab" data-bs-target="#txt2img" type="button" role="tab" aria-controls="txt2img" aria-selected="true">txt2img</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-light-grey" id="txt2video-tab" data-bs-toggle="tab" data-bs-target="#txt2video" type="button" role="tab" aria-controls="txt2video" aria-selected="false">txt2video</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-light-grey" id="img2img-tab" data-bs-toggle="tab" data-bs-target="#img2img" type="button" role="tab" aria-controls="img2img" aria-selected="false">img2img</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-light-grey" id="Inpainting-tab" data-bs-toggle="tab" data-bs-target="#Inpainting" type="button" role="tab" aria-controls="Inpainting" aria-selected="false">Inpainting</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-light-grey" id="ControlNet-tab" data-bs-toggle="tab" data-bs-target="#ControlNet" type="button" role="tab" aria-controls="ControlNet" aria-selected="false">Control Net</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-light-grey" id="NFTTransform-tab" data-bs-toggle="tab" data-bs-target="#NFTTransform" type="button" role="tab" aria-controls="NFTTransform" aria-selected="false">NFT Transform</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-light-grey" id="BuyToken-tab" data-bs-toggle="tab" data-bs-target="#BuyToken" type="button" role="tab" aria-controls="BuyToken" aria-selected="false">Buy Token</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-light-grey" id="TokenExchange-tab" data-bs-toggle="tab" data-bs-target="#TokenExchange" type="button" role="tab" aria-controls="TokenExchange" aria-selected="false">Token Exchange</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">


                <div class="tab-pane fade show active text-white"  id="txt2img" role="tabpanel" aria-labelledby="txt2img-tab" >
                    
                    <div class="row">
                        <div class="col-md-9 relative">
                            <textarea name="" id="prompt" class="form-control dark-grey border-radius-7" rows="3" placeholder="Enter the Prompt here"></textarea>
                            <div class="counterPrompt">
                                <span>91</span>
                                <span>/</span>
                                <span>150</span>
                            </div>
                            <br>
                            <textarea name="" id="neg_prompt" class="form-control dark-grey border-radius-7" rows="3" placeholder="Enter the Negative Prompt here"></textarea>
                            <div class="counterNegPrompt">
                                <span>91</span>
                                <span>/</span>
                                <span>150</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn generate purple-col-bg purple-col-border form-control text-white border-radius-7">Generate</button>
                            
                            <div class="input-group mb-2 mt-2 fourEventsActions">
                            <div class="col-md-2">
                                <button class="btn btn-success form-control text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/arrow.png')}}" class="btn_img"></button>
                            </div>
                            <div class="col-md-2">
                            <button class="btn btn-success form-control text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/trash.png')}}" class="btn_img"></button>
                            </div>
                            <div class="col-md-2">
                            <button class="btn btn-success form-control text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/left.png')}}" class="btn_img"></button>
                            </div>
                            <div class="col-md-2">
                            <button class="btn btn-success form-control text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/down.png')}}" class="btn_img"></button>
                            </div>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="" class="text-white">   &nbsp;  Prompt Styles</label>
                                    <select name="" id="" class="form-control dark-grey border-radius-7">
                                        <option value="" selected>None</option>
                                        <option value="img2img">vae-hopital-real2</option>
                                        <option value="img2img">vae-fogaminsk</option>
                                    </select>
                            </div>

                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="models_section dark-grey p-3 border-radius-7" >
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control dark-grey border-radius-7" readonly value="Lora">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button">+</button>
                                        </div>
                                        <input type="text" class="form-control dark-grey border-radius-7" readonly value="Embedding">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button">+</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="scheduler_section mt-2 dark-grey p-3 border-radius-7" >
                                <div class="col-md-12">
                                <div class="input-group">                                 
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                              
                                                <label for="">Scheduler (Sampling method)</label> 
                                                
                                                   
                                                <select name="" id="" class="form-control dark-grey border-radius-7">
                                                    <option value="" selected>None</option>
                                                    <option value="img2img">vae-hopital-real2</option>
                                                    <option value="img2img">vae-fogaminsk</option>
                                                </select>
                                               
                                                  
                                                
                                                
                                            </div>
                                            <div class="col-md-12">
                                              <div class="input-group">
                                                
                                                <div class="col-md-8">
                                                    <label for="">Seed Image</label> 
                                                    <input type="number" class="form-control dark-grey">
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-success form-control text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/dice.png')}}" class="btn_img"></button>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-success form-control text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/play.png')}}" class="btn_img"></button>
                                                </div> 
                                              </div>
                                             
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div>
                                                    <label for="">Inference Steps (Sampling Steps) </label> 
                                                
                                                    
                                                    <input type="text" value="512" class="form-control dark-grey" >
                                                </div>
                                                <div>
                                                    <input type="range" min="0" max="100" value="50" class="slider" id="myRange">
                                                </div>    
                                                
                                                
                                            </div>
                                            <div class="col-md-12">
                                            
                                                <div>
                                                    <label for="">Clip Skip</label> 
                                                    <input type="checkbox" name="" id="">
                                                    <input type="text" value="1" class="form-control dark-grey" >
                                                </div>
                                                <div>
                                                    <input type="range" min="0" max="100" value="50" class="slider" id="myRange">
                                                </div>  
                                            </div>
                                        </div>


                                        </div>
                                </div>
                                
                            </div>


                            <div class="enhancement_section mt-2 dark-grey p-3 border-radius-7" >
                                <div class="col-md-12">
                                    
                                    <div class="input-group">
                                        <input type="checkbox">
                                        <label for="">Face Enhance</label>
                                        <input type="checkbox" >
                                        <label for="">Super Resolution</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="input-group">

                                    <div class="col-md-6">
                                            <div class="col-md-12">
                                                    <label for="">Super Resolution Model</label> 
                                                <select name="" id="" class="form-control dark-grey border-radius-7">
                                                    <option value="" selected>None</option>
                                                    <option value="img2img">vae-hopital-real2</option>
                                                    <option value="img2img">vae-fogaminsk</option>
                                                </select>
                                            
                                                
                                                
                                            </div>
                                            
                                    </div>

                                    <div class="col-md-6">
                                            
                                            <div class="col-md-12">
                                            
                                                <div>
                                                    <label for="">Scale Of Super Resolution</label> 
                                                
                                                    <input type="text" value="2" class="form-control dark-grey" >
                                                </div>
                                                <div>
                                                    <input type="range" min="0" max="100" value="50" class="slider" id="myRange">
                                                </div>  
                                            </div>
                                    </div>
                                </div>
                                   
                                </div>
                                
                            </div>


                            <div class="heightandwidth_section mt-2 dark-grey p-3 border-radius-7" >
                                <div class="col-md-12">
                                    <div class="input-group">

                                  
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div>
                                                <label for="">Width</label> 
                                             
                                                <button class="btn btn-success text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/width.png')}}" class="btn_img"></button>
                                                <input type="text" value="512" class="form-control dark-grey" >
                                            </div>
                                            <div>
                                                <input type="range" min="0" max="100" value="50" class="slider" id="myRange">
                                            </div>    
                                            
                                            
                                        </div>
                                        <div class="col-md-12">
                                           
                                            <div>
                                                <label for="">Samples</label> 
                                            
                                                <input type="text" value="1" class="form-control dark-grey" >
                                            </div>
                                            <div>
                                                <input type="range" min="0" max="100" value="50" class="slider" id="myRange">
                                            </div>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div>
                                                <label for="">Height</label> 
                                             
                                                <button class="btn btn-success text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/height.png')}}" class="btn_img"></button>
                                                <input type="text" value="512" class="form-control dark-grey" >
                                            </div>
                                            <div>
                                                <input type="range" min="0" max="100" value="50" class="slider" id="myRange">
                                            </div>    
                                            
                                            
                                        </div>
                                        <div class="col-md-12">
                                           
                                            <div>
                                                <label for="">Guidance Scale(CFG Scale) </label> 
                                            
                                                <input type="text" value="1" class="form-control dark-grey" >
                                            </div>
                                            <div>
                                                <input type="range" min="0" max="100" value="50" class="slider" id="myRange">
                                            </div>  
                                        </div>
                                    </div>

                                    
                                    </div>
                                   
                                </div>
                                
                            </div>

                            <div class="miscellaneous_section mt-2 dark-grey p-3 border-radius-7" >
                                <div class="col-md-12">
                                    <div class="input-group">
                                         <input type="checkbox">
                                        <label for="">Safety Checker</label>
                                        <input type="checkbox" >
                                        <label for="">Enhance Prompt</label>
                                        <input type="checkbox" >
                                        <label for="">Multi Lingual</label>
                                        <input type="checkbox" >
                                        <label for="">Panorama</label>
                                        <input type="checkbox" >
                                        <label for="">Self Attention</label>
                                        <input type="checkbox" >
                                        <label for="">Upscale</label>
                                        <input type="checkbox" >
                                        <label for="">Tomesd</label>
                                        <input type="checkbox" >
                                        <label for="">Karras Sigmas</label>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                     
                        <div class="col-md-6 dark-grey p-3 border-radius-7 ">
                                <div class="images_result">
                                    <textarea name="" id="" class="form-control " rows="20"></textarea>
                                </div>
                                <div class="images_publishBtns">
                                    <button class="btn btn-secondary text-light-grey-bg border-radius-7 "><img src="{{asset('img/icons/publish.png')}}" class="btn_img"> Publish the Image</button>
                                    <button class="btn btn-secondary text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/creative.png')}}" class="btn_img"> Creative History</button>
                                </div>
                        </div>
                    </div>

                </div>


                <div class="tab-pane fade text-white" id="txt2video" role="tabpanel" aria-labelledby="txt2video-tab">
                    Coming Soon
                </div>
                <div class="tab-pane fade text-white" id="img2img" role="tabpanel" aria-labelledby="img2img-tab">
                        Coming Soon
                </div>
                <div class="tab-pane fade text-white" id="Inpainting" role="tabpanel" aria-labelledby="Inpainting-tab">
                        Coming Soon
                </div>
                <div class="tab-pane fade text-white" id="ControlNet" role="tabpanel" aria-labelledby="ControlNet-tab">
                        Coming Soon
                </div>
                <div class="tab-pane fade text-white" id="NFTTransform" role="tabpanel" aria-labelledby="NFTTransform-tab">
                        Coming Soon
                </div>
                <div class="tab-pane fade text-white" id="BuyToken" role="tabpanel" aria-labelledby="BuyToken-tab">
                        Coming Soon
                </div>
                <div class="tab-pane fade text-white" id="TokenExchange" role="tabpanel" aria-labelledby="TokenExchange-tab">
                        Coming Soon
                </div>
            
            </div>
        </div>

    </div>
    
    
@endsection('content')
<script>
  
</script>