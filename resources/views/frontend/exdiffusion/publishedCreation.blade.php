@extends('layouts.app')
@section('content')
<div class="publishCreationMain">
    <div class="row mainrow">
        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 title">
            <img src="{{asset('img/icons/myasset.png')}}"> Published Creations
        </div>
        <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 navigation">

            <a href="#" class="active" id="publishcreation_images_filter">Images</a>
            <a href="#" class="active" id="publishcreation_is_nsfw">Images(NSFW)</a>
            @if(Auth::user())
            <a href="#" id="publishcreation_favourite_filter">Favourite</a>
            <a href="#" id="publishcreation_basemodel_filter">Base Model</a>
            <a href="#" id="publishcreation_lora_filter">Lora</a>
            <a href="#" id="publishcreation_embedding_filter">Embedding</a>
            @endif

        </div>
        @if(Auth::user())
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 filters">
            <div class="input-group">

                <div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">

                    <select name="filterlist" id="public_creation_filterlist" disabled class="form-control dark-grey border-radius-7">
                        <option value="" selected></option>
                        <option value="addToFavoritePublishCreation">Add to Favorite</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                    <button class="btn btn-success form-control text-light-grey-bg border-radius-7" disabled id="public_creation_apply_filters">Apply</button>
                </div>

            </div>
        </div>
        @endif
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
        var lastId;
        var recordsCount = 0;

        $(document).on("click", "#load_more_publishcreation", function() {
            lastId = $(this).data('lastid');
            var selectedModelType = $(this).data('loadmore-modeltype');
            if (selectedModelType == 'undefined') {
                selectedModelType = "Images"
            }
            getPublishCreations(selectedModelType);
            setTimeout(function() {
                $('html, body').animate({
                    scrollTop: $("footer").offset().top
                }, 2000);
            }, 3000);


            if ($('.updateBlueText').text('OFF')) {
                setTimeout(function() {
                    jQuery('.is_NSFW_Images').css('filter', 'unset');
                }, 3000);
            }

        });

        function getPublishCreations(modelType) {

            console.log("modelType", modelType);
            console.log("lastId", lastId);

            $('#publicCreationModelList').hide();
            $('#publicCreationImagesList').show();
            $("#load_more_publishcreation").remove();
            $.ajax({
                url: "" + baseUrl + "/get-publish-creation",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    modelType: modelType,
                    last_id: lastId
                },
                success: function(response) {


                    // $(".masonry").empty();

                    console.log('Response Data', response);

                    if (response.data.length > 0) {
                        response.data.forEach((element) => {
                            recordsCount++;

                            var pageHTML = "<div class='grid'>";
                            var classNameForNSFW_Image = 'is_NSFW_Images';
                            if (element.is_super_resolution == 'true') {
                                pageHTML += "<img src='" + element.image_url_super_resolution + "'>";
                            } else if (element.is_nsfw_image == 'true') {
                                pageHTML += "<img src='" + element.image_url + "' class='" + classNameForNSFW_Image + "'>";
                            } else {
                                pageHTML += "<img src='" + element.image_url + "'>";
                            }

                            pageHTML += "<div class='grid__body'>";
                            // if content is adult the show label
                            if (element.is_nsfw_image == 'true') {
                                pageHTML += "<span class='checkNSFW'> NSFW </span>";
                            }
                            pageHTML += "<div class='relative'>";
                            pageHTML += "<input type='checkbox' name='' data-creativeId='" + element.id + "' class='imageCheckCreativehistory'>";
                            pageHTML += "</div>";
                            pageHTML += "<a class='grid__link' href=" + baseUrl + "/image-detail/" + element.id + "></a>";
                            pageHTML += "<div class='mt-auto masonry-btn-generate'>";
                            pageHTML += "<button class='btn purple-col-bg form-control text-white border-radius-7 generateCreativeHistory' data-creativeId='" + element.id + "'>Generate</button>";
                            pageHTML += "</div>";
                            pageHTML += "</div>";
                            pageHTML += "</div>";
                            $(".masonry").append(pageHTML);
                        });

                        //dynamic load more button with last_id and different modelType loadmore selected 
                        if (recordsCount < response.totalRecords) {
                            var pageHTML = "<div id='load_more'>";
                            pageHTML += "<button name='load_more_publishcreation' data-loadmore-modeltype='" + modelType + "' data-lastid='" + response.last_id + "' class='btn purple-col-bg text-white border-radius-7 '  id='load_more_publishcreation'>Load More</button>";
                            pageHTML += "</div>";
                            $(".publishCreationMain").append(pageHTML);
                        }

                        $("#loader").hide();
                    } else {
                        var pageHTML = "<div class='grid'>";
                        pageHTML += "<p class='text-white'> No more images found!</p>";
                        pageHTML += "</div>";

                        $(".masonry").append(pageHTML);


                        $("#loader").hide();
                    }

                    // work for blurring...
                    if (modelType == "NSFW" || modelType == "Favourite") {
                        $('#blurringContainer').remove();
                        var pageHTML = "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' id='blurringContainer'>";
                        pageHTML += "<a class='showNSFW'> <img src='https://exdiffusion.com/newproject/public/img/icons/eye-cut.png'/> </a> <span class='blurringText'>  blurring is <span class='updateBlueText'> on </span> </span>";
                        pageHTML += "</div>";
                        $("#publicCreationImagesList").prepend(pageHTML);
                    } else {
                        $('#blurringContainer').remove();
                        $('#publicCreationImagesList .grid img').removeClass('is_NSFW_Images');

                    }

                },
                error: function() {
                    $("#result").text(
                        "Error occurred while fetching data from the API."
                    );
                },
            });

        }

        getPublishCreations();

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
                                    "<div class='col-lg-2 col-md-4 col-sm-6 col-xs-12'>";
                                pageHTML += "<div class='bodyInner'>";
                                if (element.image_url != undefined || element.image_url != null) {
                                    pageHTML += "<img src='" + element.image_url + "' alt='No image' class='img-fluid mb-3'>";
                                } else {
                                    pageHTML += "<img src='https://exdiffusion.com/newproject/public/img/icons/placeholder.png' alt='No image' class='img-fluid mb-3'>";
                                }

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
                                        "<div class='col-lg-2 col-md-4 col-sm-6 col-xs-12'>";
                                    pageHTML += "<div class='bodyInner'>";
                                    if (element.image_url != undefined || element.image_url != null) {
                                        pageHTML += "<img src='" + element.image_url + "' alt='No image' class='img-fluid mb-3'>";
                                    } else {
                                        pageHTML += "<img src='https://exdiffusion.com/newproject/public/img/icons/placeholder.png' alt='No image' class='img-fluid mb-3'>";
                                    }
                                    pageHTML += " <span> " + element.model_id + "</span>";
                                    pageHTML += " </div>";
                                    pageHTML += "</div>";

                                    $("#publicCreationModelList").append(pageHTML);
                                });
                            } else {
                                var pageHTML = "<div class='grid'>";
                                pageHTML += "<p class='text-white'> No Models found!</p>";
                                pageHTML += "</div>";
                                $("#publicCreationModelList").append(pageHTML);
                                $("#loader").hide();


                            }
                        }
                        if (modelType == 'embedding_models') {
                            if (response.embeddings_models[0] !== undefined) {
                                response.embeddings_models.forEach((element) => {
                                    var pageHTML =
                                        "<div class='col-lg-2 col-md-4 col-sm-6 col-xs-12'>";
                                    pageHTML += "<div class='bodyInner'>";
                                    if (element.image_url != undefined || element.image_url != null) {
                                        pageHTML += "<img src='" + element.image_url + "' alt='No image' class='img-fluid mb-3'>";
                                    } else {
                                        pageHTML += "<img src='https://exdiffusion.com/newproject/public/img/icons/placeholder.png' alt='No image' class='img-fluid mb-3'>";
                                    }
                                    pageHTML += " <span> " + element.model_id + "</span>";
                                    pageHTML += " </div>";
                                    pageHTML += "</div>";

                                    $("#publicCreationModelList").append(pageHTML);
                                });
                            } else {
                                var pageHTML = "<div class='grid'>";
                                pageHTML += "<p class='text-white'> No Models found!</p>";
                                pageHTML += "</div>";
                                $("#publicCreationModelList").append(pageHTML);
                                $("#loader").hide();


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
            console.log("creativeId click ", creativeId);
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
                $('#public_creation_apply_filters').prop('disabled', false);
                $('#public_creation_filterlist').prop('disabled', false);
            } else {
                $('#public_creation_apply_filters').prop('disabled', true);
                $('#public_creation_filterlist').prop('disabled', true);
            }

        });



        $(document).on('click', '#publishcreation_images_filter', function() {
            $("#loader").show();
            $(".masonry").empty();
            //reset last id after success record
            lastId = null;
            recordsCount = 0;
            getPublishCreations("Images");
        });

        $(document).on('click', '#publishcreation_is_nsfw', function() {
            $("#loader").show();
            $(".masonry").empty();
            //reset last id after success record
            lastId = null;
            recordsCount = 0;
            getPublishCreations("NSFW");
        });


        $(document).on('click', '#publishcreation_favourite_filter', function() {
            $("#loader").show();
            $(".masonry").empty();
            //reset last id after success record
            lastId = null;
            recordsCount = 0;
            getPublishCreations("Favourite");
        });

        $(document).on('click', '#publishcreation_basemodel_filter', function() {
            $("#loader").show();
            $(".masonry").empty();
            //reset last id after success record
            lastId = null;
            recordsCount = 0;
            $("#load_more_publishcreation").remove();
            getAllModels('base_models');
        });

        $(document).on('click', '#publishcreation_lora_filter', function() {
            $("#loader").show();
            $(".masonry").empty();
            //reset last id after success record
            lastId = null;
            recordsCount = 0;
            $("#load_more_publishcreation").remove();
            getAllModels('lora_models');
        });

        $(document).on('click', '#publishcreation_embedding_filter', function() {
            $("#loader").show();
            $(".masonry").empty();
            //reset last id after success record
            lastId = null;
            recordsCount = 0;
            $("#load_more_publishcreation").remove();
            getAllModels('embedding_models');
        });


        $(document).on('click', '#public_creation_apply_filters', function() {
            console.log(publishCreationArray);
            var selectedAction = $('#public_creation_filterlist').val();

            if (selectedAction == 'addToFavoritePublishCreation') {
                Swal.fire({
                    title: 'Are you sure you want to add to favorite list?',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'Cancel',
                    customClass: {
                        actions: 'swal-custompopus',
                        title: 'swal-customModals'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
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
                                $(".masonry").empty();
                                getPublishCreations();
                                publishCreationArray = [];
                            },
                            error: function() {
                                $("#apply_filters").find('.loaderbtn').hide();
                                $("#loader").hide();
                                $("#result").text(
                                    "Error occurred while fetching data from the API."
                                );
                            },
                        });

                    } else if (result.isDenied) {

                        return;
                    }
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

        $(document).on('click', '.showNSFW', function() {
            var isBlurred = $('.is_NSFW_Images').css('filter') === 'blur(10px)';

            if (isBlurred) {
                $('.is_NSFW_Images').css('filter', 'unset');
                $('.updateBlueText').text('OFF');
                $('.showNSFW img').attr('src', 'https://exdiffusion.com/newproject/public/img/icons/eye-open.png');

            } else {
                $('.is_NSFW_Images').css('filter', 'blur(10px)');
                $('.updateBlueText').text('ON');
                $('.showNSFW img').attr('src', 'https://exdiffusion.com/newproject/public/img/icons/eye-cut.png');

            }

        });
    });
</script>