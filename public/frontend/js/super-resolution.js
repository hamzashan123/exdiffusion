
$(document).ready(function () {
    var superResolutionCreativeId;
    const draggableArea = $(".draggableinputarea");
    const uploadImageInput = $("#super_resolution_uploaded_image");
    const uploadButton = $("#uploadBtn");


    // Handle image upload and display
    uploadImageInput.on("change", function (e) {
        const file = e.target.files[0];
        console.log(file);
        if (file && (file.type === "image/jpeg" || file.type === "image/png")) {
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    const imageUrl = event.target.result;
                    const imageElement = $("<img>").attr("src", imageUrl);
                    draggableArea.find("img").remove();
                    draggableArea.find("label").hide();
                    draggableArea.find("input").hide();
                    draggableArea.append(imageElement).addClass("draggable");
                    // superResolutionArray = [];
                };
                reader.readAsDataURL(file);
            }
        } else {
            console.log(
                "Invalid file format. Please select a JPEG or PNG image."
            );
            alert("Invalid file format. Please select a JPEG or PNG image.");
            return;
        }
    });

    // Trigger file input click when upload button is clicked
    uploadButton.on("click", function () {
        // superResolutionArray = [];
        uploadImageInput.click();
    });

    $("[data-fancybox]").fancybox({
        // Customize options here
    });

    function updateProgressBarSuperResolution(currentTime, totalTime) {
        const progressBar = $("#progress-bar-superResolution");
        const progressLabel = $("#progress-label-superResolution");
        const percentage = (currentTime / totalTime) * 100;
        const labelSeconds = totalTime - currentTime;
        // console.log("percentage", percentage);
        progressBar.css("width", percentage + "%");
        progressLabel.text(`ETA ${labelSeconds.toFixed(2)} sec`);
    }

    $("#generateSuperResolution").on("click", function () {
        const face_enhance = $("#face_enhance").is(":checked");
        const super_resolution = $("#super_resolution").is(":checked");
        const superscale_input = $("#superscale_input").val();
        const uploadedImage = $("#super_resolution_uploaded_image");
        const super_resultion_model_id = $("#super_resultion_model_id").val();

        // Check if a file is selected

        //  console.log("length" , superResolutionArray.length);
        //  if (uploadedImage[0].files.length === 0 && superResolutionArray.length > 0) {
        //     alert("Please select a file.");
        //     return;
        //  }

        $("#generateSuperResolution").text("Generating...");
        $("#generateSuperResolution").addClass("generating");
        $(".superscaleoutputimage center").remove();

        // Create a FormData object
        const formData = new FormData();

        // Append the selected file to the FormData object

        formData.append("super_resolution", super_resolution);
        formData.append("creativeHistoryId", creativeHistoryId);
        formData.append("file", uploadedImage[0].files[0]);

        //check other params of super resolution as well
        if (superResolutionArray.length > 0) {
            formData.append("image_url", superResolutionArray[0]);
        }
        if ($("#super_resolution").is(":checked")) {
            formData.append(
                "super_resultion_model_id",
                super_resultion_model_id
            );
            formData.append("superscale_input", superscale_input);
        }
        if ($("#face_enhance").is(":checked")) {
            formData.append("face_enhance", face_enhance);
        }

        $("#generateSuperResolution").append('<div class="loaderbtn"> </div>');
        $("#generateSuperResolution").find('.loaderbtn').show();
        $.ajax({
            url: "" + baseUrl + "/get-superResolution",
            method: "POST",
            data: formData,
            processData: false, // Don't process data (needed for FormData)
            contentType: false, // Don't set content type (needed for FormData)
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                var response = response;
                console.log(response);
                console.log(response.superResolutionId);
                if (response.data.status == "success") {
                    superResolutionCreativeId = response.superResolutionId;
                    $(".hide_progress").css("visibility", "visible");
                    $(".hide_progress").removeClass("progressheightmanage");
                    $("#generateSuperResolution").find('.loaderbtn').show();
                    // progressbar interval time start
                    const totalTime = response.data.generationTime; // Total time in seconds
                    let currentTime = 0;

                    // console.log("totalTime", totalTime);

                    const interval = setInterval(function () {
                        currentTime += 0.1; // Simulating a fraction of a second
                        updateProgressBarSuperResolution(
                            currentTime,
                            totalTime
                        );
                        // console.log("currentTime", currentTime);
                        if (currentTime >= totalTime) {
                            clearInterval(interval);
                            //$("#progress-label").removeClass("hide_progress").addClass("text-success").text("Completed 100%");
                        }
                    }, 100); // Update every 100 milliseconds

                    // Function to append images
                    const etaInSeconds = response.data.generationTime;
                    function appendSuccessImages() {
                        var pageHTML = "<center> ";
                        pageHTML +=
                            " <a data-fancybox='images' href='" +
                            response.data.output[0] +
                            "'> <img src='" +
                            response.data.output[0] +
                            "' alt=''> </a>";
                        pageHTML += "</center>";

                        $(".superscaleoutputimage").append(pageHTML);
                        $(".processing").remove();
                        $("#generateSuperResolution").text("Generate");
                        $("#generateSuperResolution").removeClass("generating");
                        $(".hide_progress").css("visibility", "hidden");
                        $(".hide_progress").addClass("progressheightmanage");
                        // enable publish super resolution & creative history buttons
                        $("#super_resolution_publishImage").attr("disabled", false);
                        $("#super_resolution_creativeHistory").attr("disabled", false);
                    }

                    // Calculate milliseconds for ETA time
                    const etaInMilliseconds = etaInSeconds * 1000;

                    // Set timeout to append images after ETA time
                    setTimeout(function () {
                        appendSuccessImages();
                    }, etaInMilliseconds);
                } else if (response.data.status == "processing") {
                    var pageHTML = "<span> Image will be available </span>";
                    $(".superscaleoutputimage").append(pageHTML);
                    $("#generateSuperResolution").find('.loaderbtn').hide();
                }else if(response.data.status == "error"){

                    $("#generateSuperResolution").text('Generate');
                    $("#generateSuperResolution").find('.loaderbtn').hide();

                    Swal.fire({
                        title: response.data.message,
                        icon: 'error',
                        timer: 4000, // Auto-close the alert after 4 seconds
                        showConfirmButton: false
                    });
                }
            },
            error: function () {
                $("#generateSuperResolution").text('Generate');
                $("#generateSuperResolution").find('.loaderbtn').hide();
                Swal.fire({
                    title: response.data.message,
                    icon: 'error',
                    timer: 4000, // Auto-close the alert after 4 seconds
                    showConfirmButton: false
                });
            },
        });
    });

    $(document).on('click','#super_resolution_publishImage', function(){
        
                superResolutionCreativeId = superResolutionCreativeId;
                $("#super_resolution_publishImage").find('.loaderbtn').show();
                $.ajax({
                    url: "" + baseUrl + "/publish-image",
                    method: "POST",
                    data: {
                        creativeId : superResolutionCreativeId
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function (response) {
                        $("#super_resolution_publishImage").find('.loaderbtn').hide();
                        console.log(response);
                        if (response.status == "success") {
                            Swal.fire({
                                title: response.message,
                                icon: 'success',
                                timer: 4000, // Auto-close the alert after 4 seconds
                                showConfirmButton: true
                            });
                            
                        }else if(response.status == "failure"){
                            Swal.fire({
                                title: response.message,
                                icon: 'error',
                                timer: 4000, // Auto-close the alert after 4 seconds
                                showConfirmButton: true
                            });   
                        }
                    },
                    error: function () {
                        
                        $("#super_resolution_publishImage").find('.loaderbtn').hide();
                        $("#result").text(
                            "Error occurred while fetching data from the API."
                        );
                    },
                });
           
    });

});
