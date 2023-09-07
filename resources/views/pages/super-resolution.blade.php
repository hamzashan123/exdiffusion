<div class="tab-pane fade text-white" id="superResolution" role="tabpanel" aria-labelledby="superResolution-tab">
    <div class="row">

        <div class="col-md-6">
            <div class="images_result p-3">
                <div class="innerImageDivSuperResolutionUpload border-radius-7 ImageDraggableArea uploadBtn" id="draggableArea" style="background: #0b0f19;padding: 10px;width: 100%;">
                    <div class="draggableinputarea">

                   
                    <input type="file" id="super_resolution_uploaded_image" style="opacity:0">
                    <label for="super_resolution_uploaded_image" id="fileInputLabel">
                        <img src="{{asset('img/icons/dragdropicon.png')}}" alt="Select an Image">
                        <br/>
                        <span class="fileUploadText"> Click to upload or drag and drop <br/> PNG, JPG </span>
                    </label>
                 
                    </div>

                </div>

                <div class="images_publishBtns">
                    <button class="btn btn-secondary text-light-grey-bg border-radius-7" fdprocessedid="s5h6ym" id="uploadBtn">
                        <img src="https://exdiffusion.com/newproject/public/img/icons/upload.png" class="btn_img"> Upload Image
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="images_result p-3">

                <div class="innerImageDivSuperResolutionOutput border-radius-7 superscaleoutputimage" style="background: #0b0f19;padding: 10px;width: 100%;">

                <div id="progress-label-superResolution" class="text-center hide_progress">Completed 0%</div>
                    <div class="progress hide_progress">
                        <div id="progress-bar-superResolution" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>


                </div>

               

                <div class="images_publishBtns">
                    <button class="btn btn-secondary text-light-grey-bg border-radius-7 " fdprocessedid="aq6tyu"><img src="https://exdiffusion.com/newproject/public/img/icons/publish.png" class="btn_img"> Publish the Image</button>
                    <button class="btn btn-secondary text-light-grey-bg border-radius-7" fdprocessedid="s5h6ym"><img src="https://exdiffusion.com/newproject/public/img/icons/creative.png" class="btn_img"> Creative History</button>
                </div>


            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="enhancement_section mt-2 dark-grey p-3 border-radius-7">
                <div class="col-md-12">

                    <div class="input-group label removeBr">
                        <input type="checkbox" id="face_enhance">
                        <label for="">Face Enhance</label>

                        <input type="checkbox" id="super_resolution">
                        <label for="super_resolution">Super Resolution</label>
                    </div>
                </div>
                <div class="col-md-12 super_resolution_content">
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
        </div>
        
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 generateSuperRes">
                        <button class=" purple-col-bg form-control text-white border-radius-7" id="generateSuperResolution">Generate</button>
                </div>
        
    </div>
</div>