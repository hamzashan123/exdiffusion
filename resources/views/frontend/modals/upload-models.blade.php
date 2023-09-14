﻿<div class="modal fade" id="uploadModels" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Upload Models</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name<span class="required">*</span></label>
                        <input type="text" name="model_name" id="model_name" class="form-control" required>
                    </div>

                    <!-- Trigger word -->
                    <div class="form-group">
                        <label for="trigger_word">Trigger word<span class="required">*</span></label>
                        <input type="text" name="trigger_word" id="trigger_word" class="form-control" required>
                    </div>

                    <!-- Base Model Type -->
                    <div class="form-group">
                        <label for="base_model_type">Base Model Type<span class="required">*</span></label>
                        <select name="base_model_type" id="base_model_type" class="form-control" >
                            <option value="wifu-diffusion">wifu-diffusion</option>
                            <option value="unglobal-model">unglobal-model</option>
                            <option value="protogen-3.4">protogen-3.4</option>
                        </select>
                    </div>

                    <!-- Model Kind -->
                    <div class="form-group">
                        <label for="model_kind">Model Kind<span class="required">*</span></label>
                        <select name="model_kind" id="model_kind" class="form-control" >
                            <option value="wifu-diffusion">wifu-diffusion</option>
                            <option value="unglobal-model">unglobal-model</option>
                            <option value="protogen-3.4">protogen-3.4</option>
                        </select>
                    </div>

                    <!-- Model Format -->
                    <div class="form-group">
                        <label for="model_format">Model Format<span class="required">*</span></label>
                        <select name="model_format" id="model_format" class="form-control" >
                            <option value="wifu-diffusion">wifu-diffusion</option>
                            <option value="unglobal-model">unglobal-model</option>
                            <option value="protogen-3.4">protogen-3.4</option>
                        </select>
                    </div>

                    <!-- Download Link of model -->
                    <div class="form-group">
                        <label for="download_link_model">Download Link of model<span class="required">*</span></label>
                        <input type="text" name="download_link_model" id="download_link_model" class="form-control" required>
                    </div>

                    <!-- Description of Model -->
                    <div class="form-group">
                        <label for="download_link_model">Description of Model<span class="required">*</span></label>
                        <textarea name="description_of_models" id="description_of_models" cols="30" rows="4" class="form-control"></textarea>
                    </div>

                    <br>
                    <!-- Download Link of model -->
                    <div class="form-group">
                        <!-- <label for="upload_model_image">Example Images (optional)</label>
                        <input type="file" class="form-contol" name="upload_model_image[]" id="upload_model_image"> -->
                        
                                <div class="uploadModelImageDiv border-radius-7 ImageDraggableArea uploadBtn" id="draggableArea" style="background: #0b0f19;padding: 10px;width: 100%;">
                                    <div class="draggableinputarea">

                                
                                    <input type="file" id="upload_model_image" style="opacity:0">
                                    <label for="upload_model_image" id="upload_model_input">
                                        <img src="{{asset('img/icons/dragdropicon.png')}}" alt="Select an Image">
                                        <br/>
                                        <span class="fileUploadText"> Click to upload or drag and drop <br/> PNG, JPG </span>
                                    </label>
                                
                                    </div>

                                </div>
                            
                    </div>

                 

                     <!-- Download Link of model -->
                     <div class="form-group">
                        <input type="checkbox" id="adult_audience" name="adult_audience">
                        <label for="">For an Adult audience (NSFW)</label>
                        
                    </div>


               
                
                    <div class="form-group upload-model-btn-div">
                        <button  class="btn btn-primary" id="uploadModelBtn">Upload Model</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>