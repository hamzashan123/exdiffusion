$(document).ready(function () {
    //  var baseUrl = 'https://exdiffusion.com/newproject/public';
     var baseUrl = '';
     
    $(document).on('click','#make_creativehistory',  function(){

        const selectedBaseModelText = $('#selectedBaseModelText').val();
        const vaemodelslist = $('#vaemodelslist').val();
        const prompt = $('#prompt').val();
        const neg_prompt = $('#neg_prompt').val();
        const scheduler_list = $('#scheduler_list').val();
        const seed = $('#seed').val();
        const interference_input = $('#interference_input').val();
        const clickskip_input = $('#clickskip_input').val();
        const width_input = $('#width_input').val();
        const samples_input = $('#samples_input').val();
        const height_input = $('#height_input').val();
        const guidance_input = $('#guidance_input').val();
        const safety_checker = $("#safety_checker").is(":checked");
        const enhance_prompt = $("#enhance_prompt").is(":checked");
        const multi_lingual = $("#multi_lingual").is(":checked");
        const panorama = $("#panorama").is(":checked");
        const self_attention = $("#self_attention").is(":checked");
        const upscale = $("#upscale").is(":checked");
        const tomesd = $("#tomesd").is(":checked");
        const karras_sigmas = $("#karras_sigmas").is(":checked");

        // Create a FormData object
        const formData = new FormData();

        // Append the selected file to the FormData object
        formData.append("selectedBaseModelText", selectedBaseModelText);
        formData.append("vaemodelslist", vaemodelslist);
        formData.append("prompt", prompt);
        formData.append("neg_prompt", neg_prompt);
        formData.append("scheduler_list", scheduler_list);
        formData.append("seed", seed);
        formData.append("interference_input", interference_input);
        formData.append("clickskip_input", clickskip_input);
        formData.append("width_input", width_input);
        formData.append("samples_input", samples_input);
        formData.append("height_input", height_input);
        formData.append("guidance_input", guidance_input);
        formData.append("safety_checker", safety_checker);
        formData.append("enhance_prompt", enhance_prompt);
        formData.append("multi_lingual", multi_lingual);
        formData.append("panorama", panorama);
        formData.append("self_attention", self_attention);
        formData.append("upscale", upscale);
        formData.append("tomesd", tomesd);
        formData.append("karras_sigmas", karras_sigmas);
        // Array data
        formData.append("loraModelArray", loraModelArray);
        formData.append("embeddingModelArray", embeddingModelArray);
        formData.append("images", generatedImageArray);


        
        $("#make_creativehistory").find('.loaderbtn').show();

        $.ajax({
            url: "" + baseUrl + "/creative-history",
            method: "POST",
            data: formData,
            processData: false, // Don't process data (needed for FormData)
            contentType: false, // Don't set content type (needed for FormData)
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                
                $("#make_creativehistory").find('.loaderbtn').hide();
                console.log(response);

                if (response.status == "success") {
                    window.location.href = '/newproject/public/my-asset';
                    // window.location.href = '/my-asset';
                }else if(response.status == "failure"){
                    alert(response.message);    
                }
            },
            error: function () {
                $("#make_creativehistory").find('.loaderbtn').hide();
            
                $("#result").text(
                    "Error occurred while fetching data from the API."
                );
            },
        });
        

    });


})