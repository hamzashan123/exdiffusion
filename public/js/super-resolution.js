var baseUrl = 'https://exdiffusion.com/newproject/public';
// var baseUrl = 'http://localhost:8000';

$(document).ready(function(){
      
    const draggableArea = $('.draggableinputarea');
    const uploadImageInput = $('#super_resolution_uploaded_image');
    const uploadButton = $('.draggableinputarea');

    // Make the draggable area draggable
    draggableArea.on('mousedown', function(e) {
        e.preventDefault();
        const offsetX = e.clientX - draggableArea.offset().left;
        const offsetY = e.clientY - draggableArea.offset().top;

        $(document).on('mousemove', onMouseMove);
        $(document).on('mouseup', onMouseUp);

        function onMouseMove(event) {
            const x = event.clientX - offsetX;
            const y = event.clientY - offsetY;
            draggableArea.css({ left: x + 'px', top: y + 'px' });
        }

        function onMouseUp() {
            $(document).off('mousemove', onMouseMove);
            $(document).off('mouseup', onMouseUp);
        }
    });

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
                    draggableArea.append(imageElement).addClass('draggable');
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
        uploadImageInput.click();
    });

    $("[data-fancybox]").fancybox({
        // Customize options here
    });


    $('#generateSuperResolution').on('click', function(){
        const face_enhance = $('#face_enhance').is(':checked');
        const super_resolution = $('#super_resolution').is(':checked');
        const superscale_input = $('#superscale_input').val();
        const uploadedImage = $('#super_resolution_uploaded_image');
        const super_resultion_model_id = $('#super_resultion_model_id').val();
        
         // Check if a file is selected
         if (uploadedImage[0].files.length === 0) {
            alert("Please select a file.");
            return;
         }
         
          // Create a FormData object
        const formData = new FormData();

        // Append the selected file to the FormData object
        formData.append("face_enhance", face_enhance);
        formData.append("super_resolution", super_resolution);
        formData.append("superscale_input", superscale_input);
        formData.append("file", uploadedImage[0].files[0]);
        formData.append("super_resultion_model_id", super_resultion_model_id);

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
              var pageHTML = "<img src='https://cdn2.stablediffusionapi.com/generations/363921082961127_out.png'>";      
              $(".superscaleoutputimage").append(pageHTML);
            },
            error: function () {
              $("#result").text("Error occurred while fetching data from the API.");
            },
          });

    });


});
