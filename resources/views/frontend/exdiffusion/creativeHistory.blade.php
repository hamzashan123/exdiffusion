@extends('layouts.app')
@section('content')
<div class="creativeHistoryMain">
    <div class="row mainrow">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 title">
            <img src="{{asset('img/icons/myasset.png')}}"> My Assets
        </div>
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 navigation">

            <a href="#" class="active" id="creativeHistoryFilter"> Creative History</a>
            <select name="" id="myCreativeModelFilters">
                <option value="Favorite" disabled selected>Favorite</option>
                <option value="Images">Images</option>
                <option value="Base_Models">Base Models</option>
                <option value="Lora_Models">Lora Models</option>
                <option value="Embedding_Models">Embedding Models</option>
            </select>
            <select name="" id="">
                <option value="" disabled selected>Custom Model</option>
                <option value="">Base Models</option>
                <option value="">Lora Models</option>
                <option value="">Embedding Models</option>
            </select>
            <a href="#"> Trained Model</a>

        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 filters">
            <div class="input-group">

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

                    <select name="filterlist" id="filterlist" disabled class="form-control dark-grey border-radius-7">
                        <option value="" selected></option>
                        <option value="addToFavoriteCreativeHistory">Add to Favorite</option>
                        <option value="deleteCreativeHistory">Delete</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <button class="btn btn-success form-control text-light-grey-bg border-radius-7 relativeBtns" disabled id="apply_filters"><div class="loaderbtn"></div> Apply</button>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="masonry">
                
            </div>
        </div>
    </div>
</div>
@endsection('content')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     
     $(document).ready(function () {
        // var baseUrl = 'https://exdiffusion.com/newproject/public';
        // var baseUrl = '';

        
        
        function getUserCreativeHistory(modelType){

            $.ajax({
                url: "" + baseUrl + "/user-creative-history",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    modelType : modelType
                },
                success: function (response) {
                    console.log(response);

                    $(".masonry").empty();

                    if(response.data.length > 0){
                        response.data.forEach((element) => {
                        console.log("image_url",element.image_url);
                        var pageHTML = "<div class='grid'>";
                            pageHTML += "<img src='"+element.image_url+"'>";
                            pageHTML += "<div class='grid__body'>";
                            pageHTML += "<div class='relative'>";
                            pageHTML += "<a class='grid__link' href=''></a>";
                            pageHTML += "<input type='checkbox' name='' data-creativeId='"+element.id+"' class='imageCheckCreativehistory'>";
                            
                            pageHTML += "</div>";
                            pageHTML += "<div class='mt-auto masonry-btn-generate'>";
                            pageHTML += "<button class='btn purple-col-bg form-control text-white border-radius-7 generateCreativeHistory' data-creativeId='"+element.id+"'>Generate</button>";
                            pageHTML += "</div>";
                            pageHTML += "</div>";
                            pageHTML += "</div>";
                        $(".masonry").append(pageHTML);
                        });
                        
                     
                        $("#loader").hide();
                    }else{
                        var pageHTML = "<div class='grid'>";
                        pageHTML += "<p class='text-white'> No images found in favorites!</p>";
                        pageHTML += "</div>";

                        $(".masonry").append(pageHTML);
                       
                        
                        $("#loader").hide();
                    }
                   
                    
                },
                error: function () {
                    $("#result").text(
                        "Error occurred while fetching data from the API."
                    );
                },
            });
        }

        var creativeArray = [];

        $(document).on('change','.imageCheckCreativehistory', function() {
            var checkedCheckboxes = $('.imageCheckCreativehistory:checked').length;
            var creativeId = $(this).data("creativeid");
        
            if(!creativeArray.includes(creativeId)){
                creativeArray.push(creativeId);
            }else{
                const index = creativeArray.indexOf(creativeId);
                if (index > -1) {
                    creativeArray.splice(index, 1);
                }
            }
            console.log(creativeArray);
            if (checkedCheckboxes > 0) {
                $('#apply_filters').prop('disabled', false);
                $('#filterlist').prop('disabled', false);
            } else {
                $('#apply_filters').prop('disabled', true);
                $('#filterlist').prop('disabled', true);
            }

        });

        $(document).on('click','#apply_filters', function() {
            console.log(creativeArray);
            var selectedAction = $('#filterlist').val();

            if(selectedAction == 'deleteCreativeHistory'){
                $("#apply_filters").find('.loaderbtn').show();
                $("#loader").show();
                $.ajax({
                    url: "" + baseUrl + "/delete-userCreativeHistory",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        creativeArray : creativeArray
                    },
                    success: function (response) {
                        $("#apply_filters").find('.loaderbtn').hide();
                        $("#loader").hide();
                        $("#apply_filters").attr('disabled','true');
                        console.log(response);
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            timer: 4000, // Auto-close the alert after 4 seconds
                            showConfirmButton: false
                        });
                        //call getUserCreative history function to reload images
                        getUserCreativeHistory("creativeHistory");                    
                    },
                    error: function () {
                        $("#apply_filters").find('.loaderbtn').hide();
                        $("#loader").hide();
                        $("#apply_filters").attr('disabled','true');
                        $("#result").text(
                            "Error occurred while fetching data from the API."
                        );
                    },
                });
            }else if(selectedAction == 'addToFavoriteCreativeHistory'){
                $("#apply_filters").find('.loaderbtn').show();
                $("#loader").show();
                $.ajax({
                    url: "" + baseUrl + "/addToFavoriteCreativeHistory",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        creativeArray: creativeArray
                    },
                    success: function (response) {
                        $("#apply_filters").find('.loaderbtn').hide();
                        $("#loader").hide();
                        console.log(response);
                        Swal.fire({
                            title: response.message,
                            icon: 'success',
                            timer: 4000, // Auto-close the alert after 4 seconds
                            showConfirmButton: false
                        });
                        //call getUserCreative history function to reload images
                        getUserCreativeHistory("creativeHistory");  
                    },
                    error: function () {
                        $("#apply_filters").find('.loaderbtn').hide();
                        $("#loader").hide();
                        $("#result").text(
                            "Error occurred while fetching data from the API."
                        );
                    },
                });
            }else{
                alert('Select an option to apply!');
            }

        });

        $(document).on('change','#myCreativeModelFilters', function() {
            console.log(creativeArray);
            var selectedAction = $('#myCreativeModelFilters').val();
            if(selectedAction == 'Images'){
                $("#loader").show();
                getUserCreativeHistory(selectedAction); 
            }else if(selectedAction == 'Base_Models'){
                $("#loader").show();
                getUserCreativeHistory(selectedAction);    
            }else if(selectedAction == 'Lora_Models'){
                $("#loader").show();
                getUserCreativeHistory(selectedAction);    
            }else if(selectedAction == 'Embedding_Models'){
                $("#loader").show();
                getUserCreativeHistory(selectedAction);    
            }else{
                alert('Select an option to apply!');
            }

        });

        $(document).on('click','#creativeHistoryFilter', function() { 
            $("#loader").show();
            getUserCreativeHistory("creativeHistory");
            jQuery('#myCreativeModelFilters').val('Favorite')
        });

        $(document).on('click','.generateCreativeHistory', function() {

            var creativeId = $(this).data("creativeid");
            $("#loader").show();
            $.ajax({
                url: "" + baseUrl + "/getGeneratedImageHistory",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    creativeId : creativeId
                },
                success: function (response) {
                    console.log(response);
                    if(response.status == 'success'){
                        console.log(response.data);
                        $("#loader").hide();
                        localStorage.removeItem("creativeData");
                        localStorage.setItem("creativeData",JSON.stringify(response.data));

                        localStorage.removeItem("globalLoraModelArray");
                        localStorage.setItem("globalLoraModelArray",loraModelArray);
                        
                        // window.location.href = 'newproject/public/playground?generated=true';
                        window.location.href = baseUrl+'/playground?generated=true';
                       
                    }else{
                        console.log(response);
                        $("#loader").hide();
                    }
                     
                },
                error: function () {
                    $("#loader").hide();
                    $("#result").text(
                        "Error occurred while fetching data from the API."
                    );
                },
            });

        });
        
            
        getUserCreativeHistory();


    });
</script>