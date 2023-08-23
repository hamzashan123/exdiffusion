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


            <div class="tab-pane fade show active text-white" id="txt2img" role="tabpanel" aria-labelledby="txt2img-tab">

                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 relative">
                        <textarea name="" id="prompt"  class="form-control dark-grey border-radius-7" rows="3" placeholder="Enter the Prompt here"></textarea>
                        <div class="counterPrompt">
                            <span id="Prompt_nominatorCount">0</span>
                            <span>/</span>
                            <span id="Prompt_denominatorCount">75</span>
                        </div>
                        <br>
                        <textarea name="" id="neg_prompt" class="form-control dark-grey border-radius-7" rows="3" placeholder="Enter the Negative Prompt here"></textarea>
                        <div class="counterNegPrompt">
                            <span id="Neg_prompt_nominatorCount">0</span>
                            <span>/</span>
                            <span id="Neg_prompt_denominatorCount">75</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn generate purple-col-bg form-control text-white border-radius-7" id="generateBtn">Generate</button>

                        <div class="input-group mb-2 mt-2 fourEventsActions">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tooltipAction">
                                <button class="btn btn-success form-control text-light-grey-bg border-radius-7" id="read_lastgeneration"><img src="{{asset('img/icons/arrow.png')}}" class="btn_img"></button>
                                <span>Read Generation prompters from prompt or last generation if prompt is empty into user interface </span>

                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tooltipAction">
                                <button class="btn btn-success form-control text-light-grey-bg border-radius-7" id="clear_prompt"><img src="{{asset('img/icons/trash.png')}}" class="btn_img"></button>
                                <span>Clear Prompt</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tooltipAction">
                                <button class="btn btn-success form-control text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/left.png')}}" class="btn_img"></button>
                                <span>Apply selected styles to current prompt </span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tooltipAction">
                                <button class="btn btn-success form-control text-light-grey-bg border-radius-7" data-bs-toggle="modal" data-bs-target="#prompt_style_popup"><img src="{{asset('img/icons/down.png')}}" class="btn_img"></button>
                                <span>Save styles</span>
                            </div>
                        </div>

                        <div class="col-md-12" style="position: relative;">
                            <label for="" class="text-white"> &nbsp; Prompt Styles</label>

                            <select name="prompt_styles[]" id="prompt_styles" class="form-control dark-grey border-radius-7 js-example-basic-multiple" multiple="multiple">
                                
                                <option value="" disabled></option>
                               
                            </select>

                            <div class="input-group-append crossAll">
                                <button class="clearAllSelect2" type="button">x</button>
                            </div>
                        </div>

                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="models_section dark-grey p-3 border-radius-7">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 lora_appenddiv">
                                        <div class="input-group"> 
                                            <input type="text" class="form-control dark-grey border-radius-7 btn_width_dynamic" readonly="" value="Lora">
                                            <div class="combinebtn">
                                                <button class="combinebtnbtn" type="button" data-bs-toggle="modal" data-bs-target="#lora_model">+</button>
                                            </div>
                                        </div>

                                    
                                    </div>


                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 embedding_appenddiv">
                                        <div class="input-group"> 
                                            <input type="text" class="form-control dark-grey border-radius-7 btn_width_dynamic" readonly="" value="Embedding" fdprocessedid="ng446">
                                            <div class="combinebtn">
                                                <button class="combinebtnbtn" type="button" fdprocessedid="48m58c" data-bs-toggle="modal" data-bs-target="#embedding_model">+</button>
                                            </div>
                                        </div>

                                        

                                    </div>


                                    


                                </div>

                                    


                            </div>
                        
                        </div>

                        <div class="scheduler_section mt-2 dark-grey p-3 border-radius-7">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12">

                                            <label for="">Scheduler (Sampling method)</label>


                                            <select name="scheduler_name" id="scheduler_list" class="form-control dark-grey border-radius-7">
                                                <option value="" selected></option>
                                            </select>




                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Seed Image</label>
                                            <div class="input-group">

                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                                    <input type="number" class="form-control dark-grey border-radius-7" id="seed">
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <button class="btn btn-success form-control text-light-grey-bg border-radius-7" id="seed_dice_btn"><img src="{{asset('img/icons/dice.png')}}" class="btn_img"></button>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <button class="btn btn-success form-control text-light-grey-bg border-radius-7" id="seed_back_btn"><img src="{{asset('img/icons/play.png')}}" class="btn_img"></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12">
                                            <div class="spaceBetween">
                                                <label for="">Inference Steps (Sampling Steps) </label>



                                                <input type="number" id="interference_input" min="1" max="50" step="1" value="20" class="form-control dark-grey border-radius-7">

                                            </div>
                                            <div>
                                                <input type="range" min="1" max="50" value="20" class="slider" id="interference_range">
                                            </div>


                                        </div>
                                        <div class="col-md-12">

                                            <div class="spaceBetween">
                                                <label for="">Clip Skip</label>
                                                <div class="inner">
                                                    <input type="checkbox" name="" id="clickskip_checkbox">
                                                    <input type="number" disabled id="clickskip_input" min="1" max="8" step="1" value="1" class="form-control dark-grey border-radius-7">
                                                </div>
                                            </div>
                                            <div>
                                                <input type="range" disabled  min="1" max="8" value="1" class="slider" id="clickskip_range">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                        <div class="enhancement_section mt-2 dark-grey p-3 border-radius-7" style="display: none;">
                            <div class="col-md-12">

                                <div class="input-group label removeBr">
                                    <input type="checkbox" id="face_enhance">
                                    <label for="">Face Enhance</label>

                                    <input type="checkbox" id="super_resolution">
                                    <label for="super_resolution">Super Resolution</label>
                                </div>
                            </div>
                            <div class="col-md-12 super_resolution_content" style="display: none;">
                                <div class="input-group">

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12">
                                            <label for="">Super Resolution Model</label>
                                            <select name="super_resultion_model_id" id="super_resultion_model_id" class="form-control dark-grey border-radius-7">
                                                <option value="" selected></option>
                                                <option value="RealESRGAN_x4plus">RealESRGAN_x4plus</option>
                                                <option value="RealESRNet_x4plus">RealESRNet_x4plus</option>
                                                <option value="RealESRGAN_x4plus_anime_6B">RealESRGAN_x4plus_anime_6B</option>
                                                <option value="RealESRGAN_x2plus">RealESRGAN_x2plus</option>
                                                <option value="realesr-general-x4v3">realesr-general-x4v3</option>
                                            </select>



                                        </div>

                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                        <div class="col-md-12">

                                            <div class="spaceBetween">
                                                <label for="">Scale Of Super Resolution</label>

                                                <input type="number" id="superscale_input" min="1" max="4" step="0.1" value="2" class="form-control dark-grey border-radius-7">
                                            </div>
                                            <div>
                                                <input type="range" min="1" max="4" value="2" step="0.1" class="slider" id="superscale_range">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>


                        <div class="heightandwidth_section mt-2 dark-grey p-3 border-radius-7">
                            <div class="col-md-12">
                                <div class="input-group">


                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12">
                                            <div class="spaceBetween">
                                                <label for="">Width</label>

                                                <div class="inner">
                                                    <button class="btn btn-success text-light-grey-bg border-radius-7" id="width_button"><img src="{{asset('img/icons/width.png')}}" class="btn_img"></button>
                                                    <input type="number" id="width_input" min="64" max="2048" value="512" step="8" class="form-control dark-grey border-radius-7">
                                                </div>
                                            </div>
                                            <div>
                                                <input type="range" min="64" max="2048" value="512" step="8" class="slider" id="width_range">
                                            </div>


                                        </div>
                                        <div class="col-md-12">

                                            <div class="spaceBetween">
                                                <label for="">Samples</label>

                                                <input type="number" id="samples_input" min="1" max="4" value="1" step="1" class="form-control dark-grey border-radius-7">
                                            </div>
                                            <div>
                                                <input type="range" min="1" max="4" value="1" step="1" class="slider" id="samples_range">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12">
                                            <div class="spaceBetween">
                                                <label for="">Height</label>
                                                <div class="inner">
                                                    <button class="btn btn-success text-light-grey-bg border-radius-7" id="height_button"><img src="{{asset('img/icons/height.png')}}" class="btn_img"></button>
                                                    <input type="number" id="height_input" min="64" max="2048" value="768" step="8" class="form-control dark-grey border-radius-7">
                                                </div>
                                            </div>
                                            <div>
                                                <input type="range" min="64" max="2048" value="768" step="8" class="slider" id="height_range">
                                            </div>


                                        </div>
                                        <div class="col-md-12">

                                            <div class="spaceBetween">
                                                <label for="">Guidance Scale(CFG Scale) </label>

                                                <input type="number" id="guidance_input" min="1" max="20" step="0.1" value="7" class="form-control dark-grey border-radius-7">
                                            </div>
                                            <div>
                                                <input type="range" min="1" max="20" step="0.1" value="7" class="slider" id="guidance_range">
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>

                        <div class="miscellaneous_section mt-2 dark-grey p-3 border-radius-7">
                            <div class="col-md-12">
                                <div class="input-group miscellaneous_checkboxes">
                             
                                    <input type="checkbox" id="safety_checker">
                                    <label for="safety_checker">Safety Checker</label>
                                    
                                    <input type="checkbox" checked id="enhance_prompt">
                                    <label for="enhance_prompt">Enhance Prompt</label>

                                    
                                    <input type="checkbox" id="multi_lingual">
                                    <label for="multi_lingual">Multi Lingual</label>

                                    
                                    <input type="checkbox" id="panorama">
                                    <label for="panorama">Panorama</label>

                                   
                                    <input type="checkbox" id="self_attention">
                                    <label for="self_attention">Self Attention</label>

                                    
                                    <input type="checkbox" id="upscale">
                                    <label for="upscale">Upscale</label>

                                 
                                    <input type="checkbox" checked id="tomesd">
                                    <label for="tomesd">Tomesd</label>

                                    
                                    <input type="checkbox" checked id="karras_sigmas">
                                    <label for="karras_sigmas">Karras Sigmas</label>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="images_result p-3">

                            <div class="innerImageDiv border-radius-7" style="background: #0b0f19;padding: 10px;width: 100%;">
                                
                                <div id="progress-label" class="text-center hide_progress">Completed 0%</div>
                                <div class="progress hide_progress">
                                    <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" ></div>
                                </div>

                        


                            </div>

                            <div class="images_publishBtns">
                                <button class="btn btn-secondary text-light-grey-bg border-radius-7 " fdprocessedid="aq6tyu"><img src="https://exdiffusion.com/newproject/public/img/icons/publish.png" class="btn_img"> Publish the Image</button>
                                <button class="btn btn-secondary text-light-grey-bg border-radius-7" fdprocessedid="s5h6ym"><img src="https://exdiffusion.com/newproject/public/img/icons/creative.png" class="btn_img"> Creative History</button>
                            </div>


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
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $(document).on('click', '.bodyInner', function() {
            $('.bodyInner').removeClass('selectedModel');
            $(this).addClass('selectedModel');
            var selectedModel = $(this).siblings().text().trim();
            $('#selectedBaseModelText').val(selectedModel);
            $('.modal button.btn-close').trigger('click');
        });

    
        $('.js-example-basic-multiple').select2();



       
        // function fetchData() {
        //     $.ajax({
        //     url: '', // Update with your server endpoint
        //     method: 'GET',
        //     dataType: 'json',
        //     success: function(data) {
        //         // Assuming data.progress contains the progress percentage
        //         updateProgressBar(data.progress);
        //     },
        //     error: function() {
        //         console.error('Error fetching data.');
        //     }
        //     });
        // }

        // Fetch data initially and set interval for periodic updates
        // fetchData();
        // setInterval(fetchData, 5000); // Update interval in milliseconds


        
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