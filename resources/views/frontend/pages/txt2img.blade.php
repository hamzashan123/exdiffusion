<div class="tab-pane fade show active text-white check" id="txt2img" role="tabpanel" aria-labelledby="txt2img-tab">

    <div class="row">
        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 relative">
            <textarea name="" id="prompt" class="form-control dark-grey border-radius-7" rows="3" placeholder="Enter the Prompt here"></textarea>
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
            <button class="btn generate purple-col-bg form-control text-white border-radius-7 ajax-button relativeBtns" id="generateBtn"><div class="loaderbtn"></div> Generate</button>

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

                                        <input type="number" class="form-control dark-grey border-radius-7" max="4294967294" id="seed">
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
                                    <input type="range" disabled min="1" max="8" value="1" class="slider" id="clickskip_range">
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

                        <input type="checkbox" id="highres_fix">
                        <label for="highres_fix">High Resolution Fix </label>

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

        <div class="col-md-6" id="generateImageDiv">
            <div class="images_result p-3">

                <div class="innerImageDiv border-radius-7" style="background: #0b0f19;padding: 10px;width: 100%;">

                    <div id="progress-label" class="text-center hide_progress">Completed 0%</div>
                    <div class="progress hide_progress">
                        <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>




                </div>

                <div class="images_publishBtns">
                    <button id="make_publishimage" class="btn btn-secondary text-light-grey-bg border-radius-7 relativeBtns" disabled fdprocessedid="aq6tyu"><img src="https://exdiffusion.com/newproject/public/img/icons/publish.png" class="btn_img"><div class="loaderbtn"></div> Publish the Image</button>
                    <button id="make_creativehistory" disabled class="btn btn-secondary text-light-grey-bg border-radius-7 relativeBtns" fdprocessedid="s5h6ym"><img src="https://exdiffusion.com/newproject/public/img/icons/creative.png" class="btn_img"><div class="loaderbtn"></div> Creative History</button>
                    <button id="make_super_resolution" disabled class="btn btn-secondary text-light-grey-bg border-radius-7 relativeBtns" fdprocessedid="s5h6ym"><img src="https://exdiffusion.com/newproject/public/img/icons/makeSuperResolution.png" class="btn_img"><div class="loaderbtn"></div> Make Super Resolution</button>
                </div>


            </div>



        </div>
    </div>

</div>