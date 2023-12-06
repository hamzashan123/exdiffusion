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
                                @if($data->is_super_resolution == 'true')
                                <a data-fancybox='images' href="{{$data->image_url_super_resolution}}" >
                                <img src="{{$data->image_url_super_resolution}}" />
                                </a>
                                @else() 
                                <a data-fancybox='images' href="{{$data->image_url}}" >
                                <img src="{{$data->image_url}}" />
                                </a>
                                @endif
                        
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="dataOfImage p-3">

                <div class="border-radius-7" style="background: #0b0f19;padding: 10px;width: 100%;">
                    @if($data->is_published == "true")   
                    <div class="is_published_badge"></div>    
                    @endif
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

                    @if($data->is_super_resolution == 'true')
                        <button> Super Resolution </button> <br />
                        <strong> Face Enhance: </strong> {{ $data->super_resolution_face_enhance }} , <strong> Supre Resolution Model: </strong> {{ $data->super_resolution_model_id }}, <strong> Supre Resolution Scale: </strong> {{ $data->superscale_input }} 
                    @endif


                </div>

                <div class="images_publishBtns">
                    @if(Auth::user()->id == $data->user_id)
                    @if($data->is_published != "true")
                    <button id="btn_publishImage_imgDetail" class="btn btn-secondary text-light-grey-bg border-radius-7 relativeBtns" fdprocessedid="aq6tyu"> <img src="https://exdiffusion.com/newproject/public/img/icons/publish.png" class="btn_img"><div class="loaderbtn"></div> Publish the Image</button>
                    @endif
                    @endif
                    
                    <button id="btn_generateImage_imgDetail" class="btn btn-secondary text-light-grey-bg border-radius-7 relativeBtns" fdprocessedid="s5h6ym"> <img src="https://exdiffusion.com/newproject/public/img/icons/generate-img.png" class="btn_img"><div class="loaderbtn"></div> Generate Images </button>
                    
                    @if($data->is_super_resolution != 'true')
                    <button id="btn_superResolution_imgDetail" class="btn btn-secondary text-light-grey-bg border-radius-7 relativeBtns" fdprocessedid="s5h6ym">  <img src="https://exdiffusion.com/newproject/public/img/icons/makeSuperResolution.png" class="btn_img"><div class="loaderbtn"></div> Make Super Resolution</button>
                    @endif
                </div>


            </div>

        </div>
        @if(Auth::user()->id == $data->user_id)
        <div class="deleteImagedetailItem">
        <a href="{{route('deleteImageItem',['id' => $data->id])}}" class="btn btn-secondary text-light-grey-bg border-radius-7 relativeBtns" fdprocessedid="s5h6ym"> <span>x </span> Delete the Image </a>
        </div> 
        @endif
    </div>

</div>
@endsection('content')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    $(document).on('click','#btn_generateImage_imgDetail', function(){
            var creativeId = <?php echo $data->id ?>;
            $("#loader").show();
            $.ajax({
                url: "" + baseUrl + "/getGeneratedImageHistory",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    creativeId: creativeId
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        console.log(response.data);
                        $("#loader").hide();
                        localStorage.removeItem("creativeData");
                        localStorage.setItem("creativeData", JSON.stringify(response.data));
                        localStorage.removeItem("globalLoraModelArray");
                        localStorage.setItem("globalLoraModelArray", loraModelArray);
                        window.location.href = baseUrl + '/playground?generated=true';

                    } else {
                        console.log(response);
                        $("#loader").hide();
                    }

                },
                error: function() {
                    $("#loader").hide();
                    $("#result").text(
                        "Error occurred while fetching data from the API."
                    );
                },
            });
    });

    $(document).on('click','#btn_publishImage_imgDetail', function(){
                var creativeId = <?php echo $data->id ?>;
                $("#btn_publishImage_imgDetail").find('.loaderbtn').show();
                $.ajax({
                    url: "" + baseUrl + "/publish-image",
                    method: "POST",
                    data: {
                        creativeId : creativeId
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (response) {
                        $("#btn_publishImage_imgDetail").find('.loaderbtn').hide();
                        console.log(response);
                        if (response.status == "success") {
                            Swal.fire({
                                title: response.message,
                                icon: 'success',
                                timer: 4000, // Auto-close the alert after 4 seconds
                                showConfirmButton: true
                            }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location.reload;
                            }
                            });
                            
                            
                        }else if(response.status == "failure"){
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                timer: 4000, // Auto-close the alert after 4 seconds
                                showConfirmButton: true
                            });   
                        }
                    },
                    error: function () {
                        
                    
                        $("#result").text(
                            "Error occurred while fetching data from the API."
                        );
                    },
                });
    });

    // This function will reflect all playground data & super resolution data plus switch to super resolution tab
    $(document).on('click','#btn_superResolution_imgDetail', function(){

            var creativeId = <?php echo $data->id ?>;
            $("#loader").show();
            $.ajax({
                url: "" + baseUrl + "/getGeneratedImageHistory",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    creativeId: creativeId
                },
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        console.log(response.data);
                        $("#loader").hide();
                        localStorage.removeItem("creativeData");
                        localStorage.setItem("creativeData", JSON.stringify(response.data));
                        localStorage.removeItem("globalLoraModelArray");
                        localStorage.setItem("globalLoraModelArray", loraModelArray);
                        //need this id when going for super resolution data getting
                        // localStorage.removeItem("creativeHistoryId");
                        // localStorage.setItem("creativeHistoryId", creativeId);
                        window.location.href = baseUrl + '/playground?generated=true&super-resolution=true';

                    } else {
                        console.log(response);
                        $("#loader").hide();
                    }

                },
                error: function() {
                    $("#loader").hide();
                    $("#result").text(
                        "Error occurred while fetching data from the API."
                    );
                },
            });
    });
    

</script>