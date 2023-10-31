@extends('layouts.app')
@section('content')
<div class="publishCreationMain">
    <div class="row mainrow">
        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 title">
            <img src="{{asset('img/icons/myasset.png')}}"> Published Creations
        </div>
        <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 navigation">

            <a href="#" class="active" id="publishcreation_images_filter">Images</a>
            <a href="#" id="publishcreation_favourite_filter">Favourite</a>
            <a href="#" id="publishcreation_basemodel_filter">Base Model</a>
            <a href="#" id="publishcreation_lora_filter">Lora</a>
            <a href="#" id="publishcreation_embedding_filter">Embedding</a>

        </div>
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 filters">
            <div class="input-group">

                <div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">

                    <select name="filterlist" id="public_creation_filterlist" class="form-control dark-grey border-radius-7">
                        <option value="" selected></option>
                        <option value="addToFavoritePublishCreation">Add to Favorite</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                    <button class="btn btn-success form-control text-light-grey-bg border-radius-7" id="public_creation_apply_filters">Apply</button>
                </div>

            </div>
        </div>
    </div>
    <div class="row" id="publicCreationImagesList">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="masonry">

            </div>
        </div>
    </div>
    <div class="row" id="publicCreationModelList">

    </div>
</div>
@endsection('content')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        var publishCreationArray = [];

        function getPublishCreations(modelType) {
            $('#publicCreationModelList').hide();
            $('#publicCreationImagesList').show();

            $.ajax({
                url: "" + baseUrl + "/get-publish-creation",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    modelType: modelType
                },
                success: function(response) {
                    console.log(response);

                    $(".masonry").empty();

                    if (response.data.length > 0) {
                        response.data.forEach((element) => {
                            console.log("image_url", element.image_url);
                            var pageHTML = "<div class='grid'>";
                            pageHTML += "<img src='" + element.image_url + "'>";
                            pageHTML += "<div class='grid__body'>";
                            pageHTML += "<div class='relative'>";
                            
                            pageHTML += "<input type='checkbox' name='' data-creativeId='" + element.id + "' class='imageCheckCreativehistory'>";
                            pageHTML += "</div>";
                            pageHTML += "<a class='grid__link' href="+baseUrl+"/image-detail/"+element.id+"></a>";
                            pageHTML += "<div class='mt-auto masonry-btn-generate'>";
                            pageHTML += "<button class='btn purple-col-bg form-control text-white border-radius-7 generateCreativeHistory' data-creativeId='" + element.id + "'>Generate</button>";
                            pageHTML += "</div>";
                            pageHTML += "</div>";
                            pageHTML += "</div>";
                            $(".masonry").append(pageHTML);
                        });


                        $("#loader").hide();
                    } else {
                        var pageHTML = "<div class='grid'>";
                        pageHTML += "<p class='text-white'> No images found in favorites!</p>";
                        pageHTML += "</div>";

                        $(".masonry").append(pageHTML);


                        $("#loader").hide();
                    }


                },
                error: function() {
                    $("#result").text(
                        "Error occurred while fetching data from the API."
                    );
                },
            });

        }

        function getAllModels(modelType) {
            $('#publicCreationImagesList').hide();
            $('#publicCreationModelList').show();

            $.ajax({

                url: "" + baseUrl + "/get-base-models", // Replace with your API endpoint
                method: "GET",
                data: {},
                success: function(response) {
                    var response = JSON.parse(response);

                    console.log("response", response);

                    if (response.status == "success") {

                        $("#publicCreationModelList").empty();
                        if (modelType == 'base_models') {
                            response.models.forEach((element) => {
                                var pageHTML =
                                    "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
                                pageHTML += "<div class='bodyInner'>";
                                pageHTML +=
                                    "<img src='" +
                                    baseUrl +
                                    "/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
                                pageHTML += " <span> " + element.model_id + "</span>";
                                pageHTML += " </div>";
                                pageHTML += "</div>";

                                $("#publicCreationModelList").append(pageHTML);
                            });
                        }


                        if (modelType == 'lora_models') {
                            if (response.lora_models[0] !== undefined) {
                                response.lora_models.forEach((element) => {
                                    var pageHTML =
                                        "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
                                    pageHTML += "<div class='bodyInner'>";
                                    pageHTML +=
                                        "<img src='" +
                                        baseUrl +
                                        "/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
                                    pageHTML += " <span> " + element.model_id + "</span>";
                                    pageHTML += " </div>";
                                    pageHTML += "</div>";

                                    $("#publicCreationModelList").append(pageHTML);
                                });
                            }
                        }

                        if (modelType == 'embedding_models') {
                            if (response.embeddings_models[0] !== undefined) {
                                response.embeddings_models.forEach((element) => {
                                    var pageHTML =
                                        "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
                                    pageHTML += "<div class='bodyInner'>";
                                    pageHTML +=
                                        "<img src='" +
                                        baseUrl +
                                        "/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
                                    pageHTML += " <span> " + element.model_id + "</span>";
                                    pageHTML += " </div>";
                                    pageHTML += "</div>";

                                    $("#publicCreationModelList").append(pageHTML);
                                });
                            }
                        }

                        $("#loader").hide();
                    }
                },
                error: function() {
                    $("#result").text(
                        "Error occurred while fetching data from the API."
                    );
                },
            });
        }

        $(document).on('change', '.imageCheckCreativehistory', function() {
            var checkedCheckboxes = $('.imageCheckCreativehistory:checked').length;
            var creativeId = $(this).data("creativeid");

            if (!publishCreationArray.includes(creativeId)) {
                publishCreationArray.push(creativeId);
            } else {
                const index = publishCreationArray.indexOf(creativeId);
                if (index > -1) {
                    publishCreationArray.splice(index, 1);
                }
            }
            console.log(publishCreationArray);
            if (checkedCheckboxes > 0) {
                $('#apply_filters').prop('disabled', false);
                $('#filterlist').prop('disabled', false);
            } else {
                $('#apply_filters').prop('disabled', true);
                $('#filterlist').prop('disabled', true);
            }

        });

        getPublishCreations();

        $(document).on('click', '#publishcreation_images_filter', function() {
            $("#loader").show();
            getPublishCreations("Images");
        });

        $(document).on('click', '#publishcreation_favourite_filter', function() {
            $("#loader").show();
            getPublishCreations("Favourite");
        });

        $(document).on('click', '#publishcreation_basemodel_filter', function() {
            $("#loader").show();
            getAllModels('base_models');
        });

        $(document).on('click', '#publishcreation_lora_filter', function() {
            $("#loader").show();
            getAllModels('lora_models');
        });

        $(document).on('click', '#publishcreation_embedding_filter', function() {
            $("#loader").show();
            getAllModels('embedding_models');
        });


        $(document).on('click', '#public_creation_apply_filters', function() {
            console.log(publishCreationArray);
            var selectedAction = $('#public_creation_filterlist').val();

            if (selectedAction == 'addToFavoritePublishCreation') {
                $("#apply_filters").find('.loaderbtn').show();
                $("#loader").show();
                $.ajax({
                    url: "" + baseUrl + "/addToFavoriteCreativeHistory",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        creativeArray: publishCreationArray,
                        publishcreation: true
                    },
                    success: function(response) {
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
                        getPublishCreations();
                    },
                    error: function() {
                        $("#apply_filters").find('.loaderbtn').hide();
                        $("#loader").hide();
                        $("#result").text(
                            "Error occurred while fetching data from the API."
                        );
                    },
                });
            } else {
                alert('Select an option to apply!');
            }

        });

        $(document).on('click', '.generateCreativeHistory', function() {

            var creativeId = $(this).data("creativeid");
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

                        // window.location.href = 'newproject/public/playground?generated=true';
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

    });
</script>