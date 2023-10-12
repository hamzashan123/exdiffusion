@extends('layouts.app')
@section('content')
<div class="creativeHistoryMain">
    <div class="row mainrow">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 title">
            <img src="{{asset('img/icons/myasset.png')}}"> Image Details
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="col-md-6">


            </div>

            <div class="col-md-6">

                <div class="dataOfImage p-3">

                    <div class="border-radius-7" style="background: #0b0f19;padding: 10px;width: 100%;">


                        <strong> Basic Model: </strong> Realistic Vision V1.3 <br />
                        <strong> VAE: </strong> vae-kl-ff8-anime2 <br />
                        <strong> Lora: </strong> Realistic Vision V1.3 <br />
                        <strong> Embedding: </strong> Realistic Vision V1.3 <br />
                        <strong> Seed Number: </strong> Realistic Vision V1.3 <br />

                        <br />
                        <strong> Prompt: </strong>
                        <br /> An absolutely beautiful beach, with a blend of oranges, pinks, and yellows filling the sky, Crystal-clear waters of the sea gently kissing the shore, with sandy white beach stretching far and wide, The scene is dynamic and breathtaking, with seagulls soaring high in the sky and gently swaying palm trees, Take in the calming atmosphere and let the peacefulness wash over you,
                        <br /><br />
                        <strong> Negative Prompt: </strong>
                        <br />
                        (nsfw:1.5), ng_deepnegative_v1_75t, badhandv4, (paintings,sketches, (worst quality:2), (low quality:2), (normal quality:2), lowres, normal quality, ((monochrome)), ((grayscale)), logo, text
                        <br /><br />
                        <strong> Other Setting: </strong>
                        <br />
                        <strong> Scheduler:</strong> EulerAncestralDiscrete, <strong>Inference Steps: </strong> 25, <strong>Seed Number: </strong> 654765664, <strong>Clip Skip: </strong> 2, <strong>Width: </strong> 512, <strong>Height: </strong> 768, <strong>Guidance Scale: </strong> 7, <strong>Safe Checker: </strong> no, <strong>Enhance Prompt: </strong> yes,<strong>Multi Lingual: </strong> yes, <strong>Panorama: </strong> no, <strong>Self Attention: </strong> no, <strong>Upscale: </strong> yes, <strong>Tomesd: </strong> yes, <strong>Karras Sigmas: </strong> yes
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
</div>
@endsection('content')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>