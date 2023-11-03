@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<br>
<div class="playgroundMain">

    <div class="modelsListings input-group ">

        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">

            <label for="" class="text-white"> &nbsp; Base Model</label>
            <div class="input-group">
                <input type="text" class="form-control dark-grey border-radius-7 " id="selectedBaseModelText" value="">
                <div class="input-group-append">
                    <button class="" type="button" data-bs-toggle="modal" data-bs-target="#myModal">+</button>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 mx-3">
            <label for="" class="text-white"> &nbsp; VAE</label>
            <select name="vaemodel" id="vaemodelslist" class="form-control dark-grey border-radius-7">
                <option value="" selected></option>

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
                <button class="nav-link text-light-grey" id="superResolution-tab" data-bs-toggle="tab" data-bs-target="#superResolution" type="button" role="tab" aria-controls="super_resolution" aria-selected="true">Super Resolution</button>
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
            @include('frontend.pages.txt2img')
            @include('frontend.pages.super-resolution')
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
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        function getBaseModels() {
            // // Make an API request

            $.ajax({
                // url: '/get-base-models', // Replace with your API endpoint
                url: "" + baseUrl + "/get-base-models", // Replace with your API endpoint
                method: "GET",
                data: {},
                success: function (response) {
                    var response = JSON.parse(response);

                    console.log("response", response);

                    if (response.status == "success") {
                        $("#container").show();

                        response.models.forEach((element) => {
                            var pageHTML =
                                "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
                            pageHTML += "<div class='bodyInner'>";
                            pageHTML +=
                                "<img src='" +
                                baseUrl +
                                "/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
                            pageHTML += " </div>";
                            pageHTML += " <span> " + element.model_id + "</span>";
                            pageHTML += "</div>";

                            $("#baseModelsList").append(pageHTML);
                        });

                        if (response.vae_models[0] !== undefined) {
                            response.vae_models.forEach((element) => {
                                var pageHTML =
                                    "<option class='images' value=" +
                                    element.model_id +
                                    "> " +
                                    element.model_id +
                                    "";
                                pageHTML += "</option>";
                                $("#vaemodelslist").append(pageHTML);
                            });
                        }

                        response.lora_models.forEach((element) => {
                            var pageHTML =
                                "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
                            pageHTML +=
                                "<div class='bodyInnerLora' data-lora='" +
                                element.model_id +
                                "'>";
                            pageHTML +=
                                "<img src='" +
                                baseUrl +
                                "/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
                            pageHTML += " </div>";
                            pageHTML += " <span> " + element.model_id + "</span>";
                            pageHTML += "</div>";

                            $("#LoraModelsList").append(pageHTML);
                        });

                        response.embeddings_models.forEach((element) => {
                            var pageHTML =
                                "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
                            pageHTML +=
                                "<div class='bodyInnerEmbedding' data-embedding=" +
                                element.model_id +
                                ">";
                            pageHTML +=
                                "<img src='" +
                                baseUrl +
                                "/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
                            pageHTML += " </div>";
                            pageHTML += " <span> " + element.model_id + "</span>";
                            pageHTML += "</div>";

                            $("#EmbeddingsModelsList").append(pageHTML);
                        });

                       
                    }
                },
                error: function () {
                    $("#result").text(
                        "Error occurred while fetching data from the API."
                    );
                },
            });
        }

        function getSchedulers() {
            // // Make an API request

            $.ajax({
                //url: '/get-schedulers', // Replace with your API endpoint
                url: "" + baseUrl + "/get-schedulers", // Replace with your API endpoint
                method: "GET",
                data: {},
                success: function (response) {
                    var response = JSON.parse(response);

                    console.log("response", response);

                    if (response.status == "success") {
                        if (response.message[0] !== undefined) {
                            response.message.forEach((element) => {
                                var pageHTML =
                                    "<option class='images' value=" +
                                    element +
                                    "> " +
                                    element +
                                    "";
                                pageHTML += "</option>";
                                $("#scheduler_list").append(pageHTML);
                            });
                        }
                    }
                },
                error: function () {
                    $("#result").text(
                        "Error occurred while fetching data from the API."
                    );
                },
            });
        }

        $('[data-toggle="tooltip"]').tooltip();
        $(document).on('click', '.bodyInner', function() {
            $('.bodyInner').removeClass('selectedModel');
            $(this).addClass('selectedModel');
            var selectedModel = $(this).siblings().text().trim();
            $('#selectedBaseModelText').val(selectedModel);
            $('.modal button.btn-close').trigger('click');
        });

    
        $('.js-example-basic-multiple').select2();

        getBaseModels();
        getSchedulers();
        
    });
</script>


<script>
    $(document).ready(function() {
        const inputValue = $('#interference_input');
        const slider = $('#interference_range');

        // Function to update the slider and input value
        function updateValue(value) {
            slider.val(value);
            inputValue.val(value);
        }

        // Event listener for input changes
        inputValue.on('input', function() {
            const value = parseInt(inputValue.val());
            if (value >= 0 && value <= 100) {
                updateValue(value);
            }
        });

        // Event listener for slider changes
        slider.on('input', function() {
            const value = parseInt(slider.val());
            updateValue(value);
        });
    });
</script>

<script>
    $(document).ready(function() {
        const inputValue = $('#clickskip_input');
        const slider = $('#clickskip_range');

        // Function to update the slider and input value
        function updateValue(value) {
            slider.val(value);
            inputValue.val(value);
        }

        // Event listener for input changes
        inputValue.on('input', function() {
            const value = parseInt(inputValue.val());
            if (value >= 0 && value <= 100) {
                updateValue(value);
            }
        });

        // Event listener for slider changes
        slider.on('input', function() {
            const value = parseInt(slider.val());
            updateValue(value);
        });
    });
</script>

<script>
    $(document).ready(function() {
        const numberInput = $('#superscale_input');
        const rangeSlider = $('#superscale_range');

        numberInput.on('input', function() {
            rangeSlider.val(numberInput.val());
        });

        rangeSlider.on('input', function() {
            numberInput.val(rangeSlider.val());
        });
    });
</script>

<script>
    $(document).ready(function() {
        const inputValue = $('#width_input');
        const slider = $('#width_range');

        // Function to update the slider and input value
        function updateValue(value) {
            slider.val(value);
            inputValue.val(value);
        }

        // Event listener for input changes
        inputValue.on('input', function() {
            const value = parseInt(inputValue.val());
            if (value >= 64 && value <= 2048) {
                updateValue(value);
            }
        });

        // Event listener for slider changes
        slider.on('input', function() {
            const value = parseInt(slider.val());
            updateValue(value);
        });

        //height button click so width get same value
        const width_button = $('#width_button');
        width_button.on('click', function() {

            $('#height_input').val(inputValue.val());
            $('#height_range').val(inputValue.val());
        });

    });
</script>


<script>
    $(document).ready(function() {
        const inputValue = $('#height_input');
        const slider = $('#height_range');

        // Function to update the slider and input value
        function updateValue(value) {
            slider.val(value);
            inputValue.val(value);
        }

        // Event listener for input changes
        inputValue.on('input', function() {
            const value = parseInt(inputValue.val());
            if (value >= 64 && value <= 2048) {
                updateValue(value);
            }
        });

        // Event listener for slider changes
        slider.on('input', function() {
            const value = parseInt(slider.val());
            updateValue(value);
        });

        //height button click so width get same value
        const height_button = $('#height_button');
        height_button.on('click', function() {
            $('#width_input').val(inputValue.val());
            $('#width_range').val(inputValue.val());
        });
    });
</script>


<script>
    $(document).ready(function() {
        const inputValue = $('#samples_input');
        const slider = $('#samples_range');

        // Function to update the slider and input value
        function updateValue(value) {
            slider.val(value);
            inputValue.val(value);
        }

        // Event listener for input changes
        inputValue.on('input', function() {
            const value = parseInt(inputValue.val());
            if (value >= 0 && value <= 4) {
                updateValue(value);
            }
        });

        // Event listener for slider changes
        slider.on('input', function() {
            const value = parseInt(slider.val());
            updateValue(value);
        });
    });
</script>

<script>
    $(document).ready(function() {
        const numberInput = $('#guidance_input');
        const rangeSlider = $('#guidance_range');

        numberInput.on('input', function() {
            rangeSlider.val(numberInput.val());
        });

        rangeSlider.on('input', function() {
            numberInput.val(rangeSlider.val());
        });
    });
</script>
<script>
    $(document).ready(function(){
            const urlString = window.location;
            // Create a URL object
            const url = new URL(urlString);
            // Check if the URL has a specific parameter
            const paramName = "generated";
            const superResolutionParam = "super-resolution";
        if (url.searchParams.has(paramName)) {
            
            var creativeData = localStorage.getItem("creativeData");
            if(creativeData !== null){
                creativeData =  JSON.parse(creativeData);
                console.log('creativeData',creativeData);
                $('#selectedBaseModelText').val(creativeData['selectedBaseModelText']);
                
                $('#prompt').text(creativeData['prompt']);
                $('#neg_prompt').text(creativeData['neg_prompt']);
                
                $('#interference_input').val(creativeData['interference_input']);
                $('#interference_range').val(creativeData['interference_input']);
                $('#seed').val(creativeData['seed']);
                if(creativeData['clickskip_input'] > 1 ) {
                    $('#clickskip_input').val(creativeData['clickskip_input']);
                    $('#clickskip_range').val(creativeData['clickskip_input']);
                    $('#clickskip_input').prop('disabled',false);
                    $('#clickskip_range').prop('disabled',false);
                    $('#clickskip_checkbox').prop('checked','checked');
                }
                
                $('#width_input').val(creativeData['width_input']);
                $('#width_range').val(creativeData['width_input']);
                $('#height_input').val(creativeData['height_input']);
                $('#height_range').val(creativeData['height_input']);
                // $('#samples_input').val(creativeData['samples_input']);
                // $('#samples_range').val(creativeData['samples_input']);
                $('#guidance_input').val(creativeData['guidance_input']);
                $('#guidance_range').val(creativeData['guidance_input']);
                
                $("#safety_checker").attr("checked", JSON.parse(creativeData['safety_checker']));
                $("#enhance_prompt").attr("checked", JSON.parse(creativeData['enhance_prompt']));
                $("#multi_lingual").attr("checked", JSON.parse(creativeData['multi_lingual']));
                $("#panorama").attr("checked", JSON.parse(creativeData['panorama']));
                $("#self_attention").attr("checked", JSON.parse(creativeData['self_attention']));
                $("#upscale").attr("checked", JSON.parse(creativeData['upscale']));
                $("#tomesd").attr("checked", JSON.parse(creativeData['tomesd']));
                $("#karras_sigmas").attr("checked", JSON.parse(creativeData['karras_sigmas']));
               
                
                //very imporatant for future changes    
                // calling this function from custom.js to make dynamic div when genereate button click from my-assets page.
                var creativeLoraModelArray = [];
                var creativeLoraModelStrengthArray = [];
                if(creativeData['loraModelArray'] != null){
                    const creativeDataloraModelArray = creativeData['loraModelArray'].split(',');
                    const creativeDataloraStrengthArray = creativeData['loraModelStrength'].split(',');
                    creativeLoraModelArray.push(...creativeDataloraModelArray);
                    // creativeLoraModelStrengthArray.push(...creativeDataloraStrengthArray);
                    
                    setTimeout(function(){
                        console.log('creativeData-scheduler_list', creativeData['scheduler_list']);
                        $('#scheduler_list').val(creativeData['scheduler_list']);
                        $('#vaemodelslist').val(creativeData['vaemodelslist']);

                        //fill loraModel List on playground when generate=true 
                        $('.bodyInnerLora').each(function(element){
                            var bodyInnerLoraText = $(this).siblings('span').text().trim();
                        
                            if(creativeLoraModelArray.includes(bodyInnerLoraText)){
                                console.log("bodyInnerLoraText",bodyInnerLoraText);
                                $(this).trigger('click');
                            }
                        });

                        //fill lora models dynamic created input and slider value on load of page when generate = true
                        $('.lora_dynamic_input').each(function(index,element){
                            $(this).val(creativeDataloraStrengthArray[index]); 
                            loraModelStrength[index] = creativeDataloraStrengthArray[index];
                        });
                        $('.lora_dynamic_range').each(function(index,element){
                            $(this).val(creativeDataloraStrengthArray[index]); 
                            loraModelStrength[index] = creativeDataloraStrengthArray[index];
                        });

                    },5000);
                }

                //very imporatant for future changes  
                // calling this function from custom.js to make dynamic div when genereate button click from my-assets page.
                var creativeEmbeddingModelArray = [];
                if(creativeData['embeddingModelArray'] != null){
                    const creativeDataEmbeddingModelArray = creativeData['embeddingModelArray'].split(',');
                    creativeEmbeddingModelArray.push(...creativeDataEmbeddingModelArray);

                    generateEmbeddingDynamicContent(creativeEmbeddingModelArray);
                    setTimeout(function(){
                        $('.bodyInnerEmbedding').each(function(element){
                            var bodyInnerEmbeddingText = $(this).siblings('span').text().trim();
                        
                            if(creativeEmbeddingModelArray.includes(bodyInnerEmbeddingText)){
                                console.log("bodyInnerEmbeddingText",bodyInnerEmbeddingText);
                                $(this).trigger('click');
                            }
                        });
                    },5000);
                }
                
            }
            if(url.searchParams.has(superResolutionParam)){
                superResolutionArray = [];
                superResolutionArray.push(creativeData['image_url']);
                creativeHistoryId = creativeData['id'];
                console.log("superResolutionArray",superResolutionArray);

                const draggableArea = $(".draggableinputarea");
                const imageUrl = superResolutionArray[0];
                const imageElement = $("<img>").attr("src", imageUrl);
                draggableArea.find("img").remove();
                draggableArea.find("label").hide();
                draggableArea.find("input").hide();
                draggableArea.append(imageElement).addClass("draggable");

                $("#superResolution-tab").tab("show");
                
                
            }
        }
        
    });
</script>