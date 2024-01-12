@extends('layouts.admin')
@section('content')
<!-- Page Heading -->

<style>
    .adminPublishMain {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #1f2937;
        border-bottom: 1px solid #e3e6f0;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
    }

    .adminPublishMain .row {
        align-items: center;
    }

    .adminPublishMain input {
        height: auto;
    }

    .adminPublishMain .form-group {
        margin-bottom: 0px;
    }

    .adminPublishMain button#adminPublishSearch {
        border-top-left-radius: 0px !important;
        border-bottom-left-radius: 0px !important;
    }

    .adminPublishMainBody {
        padding: 40px;

        background: white;
        box-shadow: 0 3px 10px rgb(0 0 0 / 2%);
    }

    .adminPublishMainBodyInner .model_name {
        display: block;
        text-align: center;
        font-size: 15px;
        font-weight: bold;
        color: black;
    }

    .content_body {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }


    .content_body .input-group {
        display: block;
        text-align: center;
        margin-top: 5px;
    }

    .content_body .input-group input[type="checkbox"] {
        transform: scale(1.2);
        margin-right: 6px;
        accent-color: #a157dc;
    }

    .content_body .input-group span {
        font-weight: 700;
        color: black;
    }

    .content_body button.btn.btn-secondary {
        display: block;
        width: 100%;
        padding: 5px 10px;
        font-weight: 500;
        font-size: 13px;
        border-radius: 7px !important;
        margin-top: 10px;
        background-color: #444f5e !important;
        border-color: #444f5e !important;
    }

    .content_body button.btn.btn-primary {
        display: block;
        width: 100%;
        padding: 5px 10px;
        font-weight: 500;
        font-size: 13px;
        border-radius: 7px !important;
        margin-top: 10px;
    }

    .adminPublishMainBodyInner {
        padding: 8px;
        background: #1f2937;
        border-radius: 7px;
        margin: 10px 0px;
    }

    .adminPublishMainBodyInner img {
        height: 220px !important;
        object-fit: cover;
        width: 100%;
    }
</style>

<div class="adminPublishMain">
    <div class="row">
        <div class="col-8">
            <h5 class="m-0 font-weight-bold text-white">
                Published Images ( Reviewed )
            </h5>
        </div>
        <div class="col-4">
            <div class="form-group input-group">
                <input type="text" class="form-control" name="keyword" id="searchReviewedInput" placeholder="Search here" value="{{ old('keyword'), request()->input('keyword') }}">
                <button class="adminPublishSearch btn btn-primary" id="searchReviewedBtn"> Search </button>
            </div>
        </div>


    </div>


</div>

<div class="adminPublishMainBody" id="adminPublishMainBody">
    <div class="row reviewedImages">





    </div>

</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {

        function getReviewedImages() {

            $("#loader").show();

            $.ajax({
                url: "" + baseUrl + "/published-images-reviewed",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {},
                success: function(response) {

                    $("#loader").hide();
                    console.log(response);
                    $(".reviewedImages").empty();
                    if (response.data.length > 0) {
                        response.data.slice().reverse().forEach((element) => {
                            var pageHTML = "<div class='col-lg-2 col-md-6 col-sm-6 col-xs-12'>";
                            pageHTML += "<div class='adminPublishMainBodyInner'>";
                            if (element.is_reviewed == 'declined') {
                                pageHTML += "<div class='declinedImage'> </div>";
                            }
                            pageHTML += "<img src='" + element.image_url + "' alt='No image' class='img-fluid mb-3'>";
                            pageHTML += "<div class='content_body'>";
                            pageHTML += "<span class='model_name text-white'> " + element.selectedBaseModelText + "</span>";
                            pageHTML += "<div class='input-group'>";
                            if (element.is_nsfw_image == 'true') {
                                pageHTML += "<input checked type='checkbox' class='adminPublishMain_is_nsfw' name='adminPublishMain_is_nsfw' id='adminPublishMain_is_nsfw' />";
                                pageHTML += "<span class='text-white'> nsfw </span>";
                            } else {
                                pageHTML += "<input type='checkbox' class='adminPublishMain_is_nsfw' name='adminPublishMain_is_nsfw' id='adminPublishMain_is_nsfw' />";
                                pageHTML += "<span class='text-white'> nsfw </span>";
                            }


                            pageHTML += "</div>";
                            pageHTML += "<button class='btn btn-primary updateNsfwImage' data-updateimageId='" + element.id + "'> Update </button>";
                            if (element.is_reviewed == 'declined') {
                                pageHTML += "<button disabled class='btn btn-secondary declineNsfwImage' data-declineimageId='" + element.id + "'> Decline </button>";
                            } else {
                                pageHTML += "<button class='btn btn-secondary declineNsfwImage' data-declineimageId='" + element.id + "'> Decline </button>";
                            }
                            pageHTML += "<button class='btn btn-primary privateNsfwImage' data-privateimageId='" + element.id + "'> Private </button>";
                            pageHTML += "</div>";
                            pageHTML += "</div>";
                            pageHTML += "</div>";
                            $(".reviewedImages").append(pageHTML);
                        });
                    } else {
                        var pageHTML = "<p>No records found!</p>";
                        $(".reviewedImages").append(pageHTML);
                    }

                },
                error: function() {
                    $("#loader").hide();
                    Swal.fire({
                        title: 'Error occurred while fetching data from the API',
                        icon: 'success',
                        timer: 4000, // Auto-close the alert after 4 seconds
                        showConfirmButton: false
                    });

                },
            });

        }

        $(document).on('click', '.approveNsfwImage', function() {

            var approveimageId = $(this).attr('data-approveimageId');
            var adminPublishMainBodyInner = $(this).closest('.adminPublishMainBodyInner');
            // Find the checkbox within the 'adminPublishMainBodyInner' element
            var isNsfwCheckbox = adminPublishMainBodyInner.find('.adminPublishMain_is_nsfw');
            // Check if the checkbox is checked
            var isNsfw = isNsfwCheckbox.prop('checked');

            if (approveimageId != undefined) {
                Swal.fire({
                    title: 'Are you sure you want to approve the image?',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'Cancel',
                    customClass: {
                        actions: 'swal-custompopus',
                        title: 'swal-customModals'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(".reviewedImages").empty();
                        $("#loader").show();
                        $.ajax({
                            url: "" + baseUrl + "/published-images-approve",
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: approveimageId,
                                is_nsfw: isNsfw
                            },
                            success: function(response) {
                                $("#loader").hide();
                                console.log(response);
                                Swal.fire({
                                    title: response.message,
                                    icon: 'success',
                                    timer: 4000, // Auto-close the alert after 4 seconds
                                    showConfirmButton: false
                                });
                                getReviewedImages();

                            },
                            error: function() {
                                $("#loader").hide();
                                Swal.fire({
                                    title: 'Error occurred while fetching data from the API',
                                    icon: 'success',
                                    timer: 4000, // Auto-close the alert after 4 seconds
                                    showConfirmButton: false
                                });

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

        $(document).on('click', '.declineNsfwImage', function() {

            var declineimageId = $(this).attr('data-declineimageId');

            var adminPublishMainBodyInner = $(this).closest('.adminPublishMainBodyInner');
            // Find the checkbox within the 'adminPublishMainBodyInner' element
            var isNsfwCheckbox = adminPublishMainBodyInner.find('.adminPublishMain_is_nsfw');
            // Check if the checkbox is checked
            var isNsfw = isNsfwCheckbox.prop('checked');

            if (declineimageId != undefined) {
                Swal.fire({
                    title: 'Are you sure you want to decline the image?',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'Cancel',
                    customClass: {
                        actions: 'swal-custompopus',
                        title: 'swal-customModals'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(".reviewedImages").empty();
                        $("#loader").show();
                        $.ajax({
                            url: "" + baseUrl + "/published-images-decline",
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: declineimageId,
                                is_nsfw: isNsfw
                            },
                            success: function(response) {
                                $("#loader").hide();
                                console.log(response);
                                Swal.fire({
                                    title: response.message,
                                    icon: 'success',
                                    timer: 4000, // Auto-close the alert after 4 seconds
                                    showConfirmButton: false
                                });
                                getReviewedImages();

                            },
                            error: function() {
                                $("#loader").hide();
                                Swal.fire({
                                    title: 'Error occurred while fetching data from the API',
                                    icon: 'success',
                                    timer: 4000, // Auto-close the alert after 4 seconds
                                    showConfirmButton: false
                                });

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

        $(document).on('click', '.privateNsfwImage', function() {

            var privateimageId = $(this).attr('data-privateimageId');


            if (privateimageId != undefined) {
                Swal.fire({
                    title: 'Are you sure you want to make this image private?',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'Cancel',
                    customClass: {
                        actions: 'swal-custompopus',
                        title: 'swal-customModals'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(".reviewedImages").empty();
                        $("#loader").show();
                        $.ajax({
                            url: "" + baseUrl + "/published-images-private",
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: privateimageId,
                            },
                            success: function(response) {
                                $("#loader").hide();
                                console.log(response);
                                Swal.fire({
                                    title: response.message,
                                    icon: 'success',
                                    timer: 4000, // Auto-close the alert after 4 seconds
                                    showConfirmButton: false
                                });
                                getReviewedImages();

                            },
                            error: function() {
                                $("#loader").hide();
                                Swal.fire({
                                    title: 'Error occurred while fetching data from the API',
                                    icon: 'success',
                                    timer: 4000, // Auto-close the alert after 4 seconds
                                    showConfirmButton: false
                                });

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

        $(document).on('click', '.updateNsfwImage', function() {

            var updateimageId = $(this).attr('data-updateimageId');
            var adminPublishMainBodyInner = $(this).closest('.adminPublishMainBodyInner');
            // Find the checkbox within the 'adminPublishMainBodyInner' element
            var isNsfwCheckbox = adminPublishMainBodyInner.find('.adminPublishMain_is_nsfw');
            // Check if the checkbox is checked
            var isNsfw = isNsfwCheckbox.prop('checked');

            if (updateimageId != undefined) {
                Swal.fire({
                    title: 'Are you sure you want to update the image?',
                    showDenyButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'Cancel',
                    customClass: {
                        actions: 'swal-custompopus',
                        title: 'swal-customModals'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(".reviewedImages").empty();
                        $("#loader").show();
                        $.ajax({
                            url: "" + baseUrl + "/published-images-update",
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: updateimageId,
                                is_nsfw: isNsfw
                            },
                            success: function(response) {
                                $("#loader").hide();
                                console.log(response);
                                Swal.fire({
                                    title: response.message,
                                    icon: 'success',
                                    timer: 4000, // Auto-close the alert after 4 seconds
                                    showConfirmButton: false
                                });
                                getReviewedImages();

                            },
                            error: function() {
                                $("#loader").hide();
                                Swal.fire({
                                    title: 'Error occurred while fetching data from the API',
                                    icon: 'success',
                                    timer: 4000, // Auto-close the alert after 4 seconds
                                    showConfirmButton: false
                                });

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

        $("#searchReviewedInput").keypress(function(event) {
            // Check if the pressed key is Enter (key code 13)
            if (event.which === 13) {
            // Trigger the click event on the search button
            $("#searchReviewedBtn").click();
            }
        });

        $(document).on('click', '#searchReviewedBtn', function() {

            var keyword = $('#searchReviewedInput').val();
            if (keyword == undefined || keyword == null || keyword == '') {
                Swal.fire({
                    title: 'Enter the model name to search!',
                    icon: 'warning',
                    timer: 4000, // Auto-close the alert after 4 seconds
                    showConfirmButton: false
                });
            }
            $(".reviewedImages").empty();
            $("#loader").show();
            $.ajax({
                url: "" + baseUrl + "/published-images-search",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    searchType: 'Reviewed',
                    keyword: keyword
                },
                success: function(response) {
                    $("#loader").hide();
                    console.log(response);
                    $(".reviewedImages").empty();
                    if (response.data.length > 0) {
                        response.data.slice().reverse().forEach((element) => {
                            var pageHTML = "<div class='col-lg-2 col-md-6 col-sm-6 col-xs-12'>";
                            pageHTML += "<div class='adminPublishMainBodyInner'>";
                            if (element.is_reviewed == 'declined') {
                                pageHTML += "<div class='declinedImage'> </div>";
                            }
                            pageHTML += "<img src='" + element.image_url + "' alt='No image' class='img-fluid mb-3'>";
                            pageHTML += "<div class='content_body'>";
                            pageHTML += "<span class='model_name text-white'> " + element.selectedBaseModelText + "</span>";
                            pageHTML += "<div class='input-group'>";
                            if (element.is_nsfw_image == 'true') {
                                pageHTML += "<input checked type='checkbox' class='adminPublishMain_is_nsfw' name='adminPublishMain_is_nsfw' id='adminPublishMain_is_nsfw' />";
                                pageHTML += "<span class='text-white'> nsfw </span>";
                            } else {
                                pageHTML += "<input type='checkbox' class='adminPublishMain_is_nsfw' name='adminPublishMain_is_nsfw' id='adminPublishMain_is_nsfw' />";
                                pageHTML += "<span class='text-white'> nsfw </span>";
                            }


                            pageHTML += "</div>";
                            pageHTML += "<button class='btn btn-primary updateNsfwImage' data-updateimageId='" + element.id + "'> Update </button>";
                            if (element.is_reviewed == 'declined') {
                                pageHTML += "<button disabled class='btn btn-secondary declineNsfwImage' data-declineimageId='" + element.id + "'> Decline </button>";
                            } else {
                                pageHTML += "<button class='btn btn-secondary declineNsfwImage' data-declineimageId='" + element.id + "'> Decline </button>";
                            }
                            pageHTML += "<button class='btn btn-primary privateNsfwImage' data-privateimageId='" + element.id + "'> Private </button>";
                            pageHTML += "</div>";
                            pageHTML += "</div>";
                            pageHTML += "</div>";
                            $(".reviewedImages").append(pageHTML);
                        });
                    } else {
                        var pageHTML = "<p>No records found!</p>";
                        $(".reviewedImages").append(pageHTML);
                    }


                },
                error: function() {
                    $("#loader").hide();
                    Swal.fire({
                        title: 'Error occurred while fetching data from the API',
                        icon: 'success',
                        timer: 4000, // Auto-close the alert after 4 seconds
                        showConfirmButton: false
                    });

                },
            });

        });
        getReviewedImages();


    });
</script>
@endsection