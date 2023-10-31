@extends('layouts.app')
@section('content')
<div class="creativeHistoryMain">
    <div class="row mainrow">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 title">
            <img src="{{asset('img/icons/myasset.png')}}"> Image Details
        </div>
    </div>
    <div class="row">


        <div class="col-md-6">
            <div class="imageDetailsMain">
                <div class="border-radius-7" style="background: #0b0f19;width: 100%;">
                    <div class="imgDiv">
                        <img src="{{$data->image_url}}" />
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="dataOfImage p-3">

                <div class="border-radius-7" style="background: #0b0f19;padding: 10px;width: 100%;">


                    <strong> Basic Model: </strong> {{$data->selectedBaseModelText}} <br />
                    <strong> VAE: </strong> {{$data->vaemodelslist}} <br />
                    <strong> Lora: </strong> {{$data->loraModelArray}} <br />
                    <strong> Embedding: </strong> {{$data->embeddingModelArray}} <br />
                    <strong> Seed Number: </strong> {{$data->seed}} <br />

                    <br />
                    <strong> Prompt: </strong>
                    <br /> {{$data->prompt}}
                    <br /><br />
                    <strong> Negative Prompt: </strong>
                    <br />
                    {{$data->neg_prompt}}
                    <br /><br />
                    <strong> Other Setting: </strong>
                    <br />
                    <strong> Scheduler:</strong> {{$data->scheduler_list}} , <strong>Inference Steps: </strong> {{$data->interference_input}} , <strong>Seed Number: </strong>  {{$data->seed}} , <strong>Clip Skip: </strong>  {{$data->clickskip_input}} , <strong>Width: </strong> {{$data->width_input}}, <strong>Height: </strong> {{$data->height_input}} , <strong>Guidance Scale: </strong> {{$data->guidance_input}} , <strong>Safe Checker: </strong> {{$data->safety_checker}} , <strong>Enhance Prompt: </strong> {{$data->enhance_prompt}} ,<strong>Multi Lingual: </strong> {{$data->multi_lingual}} , <strong>Panorama: </strong> {{$data->panorama}} , <strong>Self Attention: </strong> {{$data->self_attention}}, <strong>Upscale: </strong> {{$data->upscale}}, <strong>Tomesd: </strong> {{$data->tomesd}} , <strong>Karras Sigmas: </strong> {{$data->karras_sigmas}}
                    <br /><br />

                    <button> Super Resolution </button> <br />
                    <strong> Face Enhance: </strong> yes, <strong> Supre Resolution Model: </strong> RealESRNet_x4plus, <strong> Supre Resolution Scale: </strong> 1.5



                </div>

                <div class="images_publishBtns">
                    <button class="btn btn-secondary text-light-grey-bg border-radius-7 " fdprocessedid="aq6tyu"><img src="https://exdiffusion.com/newproject/public/img/icons/publish.png" class="btn_img"> Publish the Image</button>
                    <button class="btn btn-secondary text-light-grey-bg border-radius-7" fdprocessedid="s5h6ym"><img src="https://exdiffusion.com/newproject/public/img/icons/generate-img.png" class="btn_img"> Generate Images </button>
                    <button id="" class="btn btn-secondary text-light-grey-bg border-radius-7" fdprocessedid="s5h6ym"><img src="https://exdiffusion.com/newproject/public/img/icons/makeSuperResolution.png" class="btn_img"> Make Super Resolution</button>
                </div>


            </div>

        </div>
    </div>

</div>
@endsection('content')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>