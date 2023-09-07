var baseUrl = 'https://exdiffusion.com/newproject/public';
// var baseUrl = 'http://localhost:8000';

$(document).ready(function(){
      
    const draggableArea = $('.draggableinputarea');
    const uploadImageInput = $('#super_resolution_uploaded_image');
    const uploadButton = $('#uploadBtn');

    // Handle image upload and display
    uploadImageInput.on('change', function(e) {
        
        const file = e.target.files[0];
        console.log(file);
        if (file && (file.type === 'image/jpeg' || file.type === 'image/png')) {
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const imageUrl = event.target.result;
                    const imageElement = $('<img>').attr('src', imageUrl);
                    draggableArea.find('img').remove();
                    draggableArea.find('label').hide();
                    draggableArea.find('input').hide();
                    draggableArea.append(imageElement).addClass('draggable');
                    superResolutionArray = [];
                };
                reader.readAsDataURL(file);
            }
        } else {
            console.log('Invalid file format. Please select a JPEG or PNG image.');
            alert('Invalid file format. Please select a JPEG or PNG image.');
            return;
        }
    });

    // Trigger file input click when upload button is clicked
    uploadButton.on('click', function() {
        superResolutionArray = [];
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
        console.log("percentage",percentage);
        progressBar.css("width", percentage + "%");
        progressLabel.text(`ETA ${labelSeconds.toFixed(2)} sec`);
      }

    $('#generateSuperResolution').on('click', function(){

       

        const face_enhance = $('#face_enhance').is(':checked');
        const super_resolution = $('#super_resolution').is(':checked');
        const superscale_input = $('#superscale_input').val();
        const uploadedImage = $('#super_resolution_uploaded_image');
        const super_resultion_model_id = $('#super_resultion_model_id').val();
        
         // Check if a file is selected

        //  console.log("length" , superResolutionArray.length);
        //  if (uploadedImage[0].files.length === 0 && superResolutionArray.length > 0) {
        //     alert("Please select a file.");
        //     return;
        //  }

        
         
         $('#generateSuperResolution').text('Generating');
         $('#generateSuperResolution').addClass('generating');
         $('.superscaleoutputimage center').remove();
         

          // Create a FormData object
        const formData = new FormData();

        // Append the selected file to the FormData object
        formData.append("face_enhance", face_enhance);
        formData.append("super_resolution", super_resolution);
        formData.append("superscale_input", superscale_input);
        formData.append("file", uploadedImage[0].files[0]);
        formData.append("super_resultion_model_id", super_resultion_model_id);

        if (superResolutionArray.length > 0) { 
            formData.append("image_url", superResolutionArray[0]);
         }

        $.ajax({
            url: '' + baseUrl + '/get-superResolution',
            method: "POST",
            data: formData,
            processData: false, // Don't process data (needed for FormData)
            contentType: false, // Don't set content type (needed for FormData)
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {
              var response = JSON.parse(response);
              console.log(response);
        if(response.status == "success"){

            
            $('.hide_progress').css('visibility','visible');
            $('.hide_progress').removeClass('progressheightmanage');
            // progressbar interval time start
            const totalTime = response.generationTime; // Total time in seconds
            let currentTime = 0;
                
            console.log("totalTime",totalTime);

            const interval = setInterval(function() {
                currentTime += 0.1; // Simulating a fraction of a second
                updateProgressBarSuperResolution(currentTime, totalTime);
                console.log("currentTime",currentTime);
                if (currentTime >= totalTime) {
                    clearInterval(interval);
                    //$("#progress-label").removeClass("hide_progress").addClass("text-success").text("Completed 100%");
                }
            }, 100); // Update every 100 milliseconds

            // Function to append images
         const etaInSeconds = response.generationTime;   
         function appendSuccessImages() {

              var pageHTML = "<center> "; 
              pageHTML += " <a data-fancybox='images' href='" + response.output[0] + "'> <img src='" + response.output[0] + "' alt=''> </a>";
              pageHTML += "</center>";

              $(".superscaleoutputimage").append(pageHTML);
              $(".processing").remove();
              $('#generateSuperResolution').text('Generate');
              $('#generateSuperResolution').removeClass('generating');
              $('.hide_progress').css('visibility','hidden');
              $('.hide_progress').addClass('progressheightmanage');

         }
         
           // Calculate milliseconds for ETA time
           const etaInMilliseconds = etaInSeconds * 1000;

           // Set timeout to append images after ETA time
           setTimeout(function() {
              appendSuccessImages();
           }, etaInMilliseconds);

             
        }
        else if(response.status == "processing"){
                var pageHTML = "<span> Image will be available </span>";      
                $(".superscaleoutputimage").append(pageHTML);
        }
            },
            error: function () {
              $("#result").text("Error occurred while fetching data from the API.");
            },
          });

    });


});
