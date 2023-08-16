﻿@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<br>
<div class="playgroundMain">

    <div class="modelsListings input-group ">

        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">

            <label for="" class="text-white"> &nbsp; Base Model</label>
            <div class="input-group">
                <input type="text" class="form-control dark-grey border-radius-7 " id="selectedBaseModelText" value="Realistic Vision V1.3">
                <div class="input-group-append">
                    <button class="" type="button" data-bs-toggle="modal" data-bs-target="#myModal">+</button>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 mx-3">
            <label for="" class="text-white"> &nbsp; VAE</label>
            <select name="vaemodel" id="vaemodelslist" class="form-control dark-grey border-radius-7">
                <option value="" selected>None</option>
                
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
                        <textarea name="" id="prompt" class="form-control dark-grey border-radius-7" rows="4" placeholder="Enter the Prompt here"></textarea>
                        <div class="counterPrompt">
                            <span>91</span>
                            <span>/</span>
                            <span>150</span>
                        </div>
                        <br>
                        <textarea name="" id="neg_prompt" class="form-control dark-grey border-radius-7" rows="4" placeholder="Enter the Negative Prompt here"></textarea>
                        <div class="counterNegPrompt">
                            <span>91</span>
                            <span>/</span>
                            <span>150</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn generate purple-col-bg purple-col-border form-control text-white border-radius-7">Generate</button>

                        <div class="input-group mb-2 mt-2 fourEventsActions">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                                <button class="btn btn-success form-control text-light-grey-bg border-radius-7" data-toggle="tooltip" data-placement="bottom" title="Read Generation prompters from prompt or last generation if prompt is empty into user interface"><img src="{{asset('img/icons/arrow.png')}}" class="btn_img"></button>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                                <button class="btn btn-success form-control text-light-grey-bg border-radius-7" data-toggle="tooltip" data-placement="bottom" title="Clear Prompt"><img src="{{asset('img/icons/trash.png')}}" class="btn_img"></button>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                                <button class="btn btn-success form-control text-light-grey-bg border-radius-7" data-toggle="tooltip" data-placement="bottom" title="Apply selected styles to current prompt"><img src="{{asset('img/icons/left.png')}}" class="btn_img"></button>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                                <button class="btn btn-success form-control text-light-grey-bg border-radius-7" data-toggle="tooltip" data-placement="bottom" title="Save styles"><img src="{{asset('img/icons/down.png')}}" class="btn_img"></button>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="" class="text-white"> &nbsp; Prompt Styles</label>

                            <select name="prompt_styles[]" id="prompt_styles" class="form-control dark-grey border-radius-7 js-example-basic-multiple" multiple="multiple">
                                <option value="">None</option>
                                <option value="img2img">vae-hopital-real2</option>
                                <option value="img2img">vae-fogaminsk</option>
                            </select>
                        </div>

                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="models_section dark-grey p-3 border-radius-7">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-group"> <input type="text" class="form-control dark-grey border-radius-7" readonly="" value="Lora">
                                            <div class="combinebtn">
                                                <button class="combinebtnbtn" type="button" data-bs-toggle="modal" data-bs-target="#lora_model">+</button>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                                        <div class="input-group"> <input type="text" class="form-control dark-grey border-radius-7" readonly="" value="Embedding" fdprocessedid="ng446">
                                            <div class="combinebtn">
                                                <button class="combinebtnbtn" type="button" fdprocessedid="48m58c">+</button>
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


                                            <select name="" id="" class="form-control dark-grey border-radius-7">
                                                <option value="" selected>None</option>
                                                <option value="img2img">vae-hopital-real2</option>
                                                <option value="img2img">vae-fogaminsk</option>
                                            </select>




                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Seed Image</label>
                                            <div class="input-group">

                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">

                                                    <input type="number" class="form-control dark-grey border-radius-7">
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <button class="btn btn-success form-control text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/dice.png')}}" class="btn_img"></button>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <button class="btn btn-success form-control text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/play.png')}}" class="btn_img"></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12">
                                            <div class="spaceBetween">
                                                <label for="">Inference Steps (Sampling Steps) </label>



                                                <input type="number" id="interference_input" min="0" max="100" step="1" value="50" class="form-control dark-grey border-radius-7">

                                            </div>
                                            <div>
                                                <input type="range" min="0" max="100" value="50" class="slider" id="interference_range">
                                            </div>


                                        </div>
                                        <div class="col-md-12">

                                            <div class="spaceBetween">
                                                <label for="">Clip Skip</label>
                                                <div class="inner">
                                                    <input type="checkbox" name="" id="">
                                                    <input type="number" id="clickskip_input" min="0" max="100" step="1" value="50" class="form-control dark-grey border-radius-7">
                                                </div>
                                            </div>
                                            <div>
                                                <input type="range" min="0" max="100" value="50" class="slider" id="clickskip_range">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                        <div class="enhancement_section mt-2 dark-grey p-3 border-radius-7">
                            <div class="col-md-12">

                                <div class="input-group label removeBr">
                                    <input type="checkbox">
                                    <label for="">Face Enhance</label>

                                    <input type="checkbox">
                                    <label for="">Super Resolution</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12">
                                            <label for="">Super Resolution Model</label>
                                            <select name="" id="" class="form-control dark-grey border-radius-7">
                                                <option value="" selected>None</option>
                                                <option value="img2img">vae-hopital-real2</option>
                                                <option value="img2img">vae-fogaminsk</option>
                                            </select>



                                        </div>

                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                        <div class="col-md-12">

                                            <div class="spaceBetween">
                                                <label for="">Scale Of Super Resolution</label>

                                                <input type="number" id="superscale_input" min="0" max="100" step="1" value="50" class="form-control dark-grey border-radius-7">
                                            </div>
                                            <div>
                                                <input type="range" min="0" max="100" value="50" class="slider" id="superscale_range">
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
                                                    <button class="btn btn-success text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/width.png')}}" class="btn_img"></button>
                                                    <input type="number" id="width_input" min="0" max="1000" step="1" value="512" class="form-control dark-grey border-radius-7">
                                                </div>
                                            </div>
                                            <div>
                                                <input type="range" min="0" max="1000" value="512" class="slider" id="width_range">
                                            </div>


                                        </div>
                                        <div class="col-md-12">

                                            <div class="spaceBetween">
                                                <label for="">Samples</label>

                                                <input type="number" id="samples_input" min="0" max="4" step="1" value="2" class="form-control dark-grey border-radius-7">
                                            </div>
                                            <div>
                                                <input type="range" min="0" max="4" value="50" class="slider" id="samples_range">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-12">
                                            <div class="spaceBetween">
                                                <label for="">Height</label>
                                                <div class="inner">
                                                    <button class="btn btn-success text-light-grey-bg border-radius-7"><img src="{{asset('img/icons/height.png')}}" class="btn_img"></button>
                                                    <input type="number" id="height_input" min="0" max="1000" step="1" value="512" class="form-control dark-grey border-radius-7">
                                                </div>
                                            </div>
                                            <div>
                                                <input type="range" min="0" max="1000" value="512" class="slider" id="height_range">
                                            </div>


                                        </div>
                                        <div class="col-md-12">

                                            <div class="spaceBetween">
                                                <label for="">Guidance Scale(CFG Scale) </label>

                                                <input type="number" id="guidance_input" min="0" max="100" step="1" value="50" class="form-control dark-grey border-radius-7">
                                            </div>
                                            <div>
                                                <input type="range" min="0" max="100" value="50" class="slider" id="guidance_range">
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>

                        <div class="miscellaneous_section mt-2 dark-grey p-3 border-radius-7">
                            <div class="col-md-12">
                                <div class="input-group miscellaneous_checkboxes">
                                    <input type="checkbox">
                                    <label for="">Safety Checker</label>
                                    <input type="checkbox">
                                    <label for="">Enhance Prompt</label>
                                    <input type="checkbox">
                                    <label for="">Multi Lingual</label>
                                    <input type="checkbox">
                                    <label for="">Panorama</label>
                                    <input type="checkbox">
                                    <label for="">Self Attention</label>
                                    <input type="checkbox">
                                    <label for="">Upscale</label>
                                    <input type="checkbox">
                                    <label for="">Tomesd</label>
                                    <input type="checkbox">
                                    <label for="">Karras Sigmas</label>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="images_result p-3">

                            <div class="innerImageDiv border-radius-7" style="background: #0b0f19;padding: 10px;width: 100%;">
                                <img src="https://exdiffusion.com/newproject/public/img/icons/ai1.png" alt="">
                                <img src="https://exdiffusion.com/newproject/public/img/icons/ai2.png" alt="">
                                <img src="https://exdiffusion.com/newproject/public/img/icons/ai3.png" alt="">
                                <img src="https://exdiffusion.com/newproject/public/img/icons/ai4.png" alt="">
                                <div id="progress-label" class="text-center">Completed 45%</div>
                                <div class="progress">
                                    <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>
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

        $(document).on('click', '.bodyInnerLora', function() {

            if ($(this).hasClass('selectedLoraModel')) {
                $(this).removeClass('selectedLoraModel');
            } else {
                $(this).addClass('selectedLoraModel');
            }

        });




        $('.js-example-basic-multiple').select2();



        function updateProgressBar(percentage) {
            $('#progress-bar').css('width', percentage + '%');
            $('#progress-label').text('Completed ' + percentage + '%');
        }

        updateProgressBar(45);
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
        const inputValue = $('#superscale_input');
        const slider = $('#superscale_range');

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
            if (value >= 0 && value <= 1000) {
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
            if (value >= 0 && value <= 1000) {
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
        const inputValue = $('#guidance_input');
        const slider = $('#guidance_range');

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