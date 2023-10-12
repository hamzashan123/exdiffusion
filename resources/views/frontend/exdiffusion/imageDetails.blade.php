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
    </div>
</div>
@endsection('content')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>