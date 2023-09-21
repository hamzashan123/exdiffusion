// var baseUrl = 'https://exdiffusion.com/newproject/public';
var baseUrl = '';

var superResolutionArray = [];
$(document).ready(function(){
      getBaseModels();
      getSchedulers();  
     
      
      $("[data-fancybox]").fancybox({
        // Customize options here
      });

      $(document).on('click',"#uploadModelBtn" , function() {
        $("#uploadModels").modal("hide");
        setTimeout(function(){
          $("#uploadmodels-success").modal("show");
        },500);
      });

     

      

    

});



function getBaseModels(){
           
    $("#loader").show();
 
    // // Make an API request
    
    $.ajax({
      // url: '/get-base-models', // Replace with your API endpoint
      url: ''+baseUrl+'/get-base-models', // Replace with your API endpoint
      method: "GET",
      data: {

      },
      success: function (response) {
      
        var response = JSON.parse(response);
        
        console.log('response', response);

        if(response.status == "success"){
            $("#container").show();
            $("#loader").hide();   




            response.models.forEach((element) => {
                var pageHTML = "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
                pageHTML += "<div class='bodyInner'>";
                pageHTML += "<img src='"+baseUrl+"/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
                pageHTML += " </div>";
                pageHTML += " <span> "+element.model_id+"</span>";
                pageHTML += "</div>";
                
                $("#baseModelsList").append(pageHTML);
                    
            });

            if(response.vae_models[0] !== undefined){

              response.vae_models.forEach((element) => {
                  var pageHTML = "<option class='images' value="+element.model_id+"> "+element.model_id+"";
                  pageHTML += "</option>";
                  $("#vaemodelslist").append(pageHTML);
                      
              });
            }

            response.lora_models.forEach((element) => {
              var pageHTML = "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
              pageHTML += "<div class='bodyInnerLora' data-lora='"+element.model_id+"'>";
              pageHTML += "<img src='"+baseUrl+"/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
              pageHTML += " </div>";
              pageHTML += " <span> "+element.model_id+"</span>";
              pageHTML += "</div>";
              
              $("#LoraModelsList").append(pageHTML);
                  
            });

            response.embeddings_models.forEach((element) => {
              var pageHTML = "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
              pageHTML += "<div class='bodyInnerEmbedding' data-embedding="+element.model_id+">";
              pageHTML += "<img src='"+baseUrl+"/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
              pageHTML += " </div>";
              pageHTML += " <span> "+element.model_id+"</span>";
              pageHTML += "</div>";
              
              $("#EmbeddingsModelsList").append(pageHTML);
                  
            });
        
          }
   
 },
 error: function () {
  $("#loader").hide();  
   $("#result").text(
     "Error occurred while fetching data from the API."
   );
 },
});
} 

function getSchedulers(){
           
    $("#loader").show();

    // // Make an API request
    
    $.ajax({
      //url: '/get-schedulers', // Replace with your API endpoint
      url: ''+baseUrl+'/get-schedulers', // Replace with your API endpoint
      method: "GET",
      data: {

      },
      success: function (response) {
      
        var response = JSON.parse(response);
        
        console.log('response', response);

        if(response.status == "success"){

            $("#loader").hide();   

            if(response.message[0] !== undefined){

              response.message.forEach((element) => {
                  var pageHTML = "<option class='images' value="+element+"> "+element+"";
                  pageHTML += "</option>";
                  $("#scheduler_list").append(pageHTML);
                      
              });
            }
        
        }
  
    },
    error: function () {
        $("#loader").hide();  
        $("#result").text(
          "Error occurred while fetching data from the API."
        );
        },
    });
} 

// restart stablediffusion server
$('#restart_server').on('click' , function(){
  $.ajax({
    url: '' + baseUrl + '/restart',
    method: "POST",
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {
    
    },
    success: function (response) {
      
      var response = JSON.parse(response);

      $(".server_restart").remove();
      $(".innerImageDiv").find("img").remove(); 
      var pageHTML = "<div class='server_restart'> <p> "+ response.message+"</p> </div>";
      $(".innerImageDiv").append(pageHTML);
      console.log(response);
    },
    error: function () {
      $("#result").text("Error occurred while fetching data from the API.");
    },
  });
});

function updateProgressBar(currentTime, totalTime) {
  const progressBar = $("#progress-bar");
  const progressLabel = $("#progress-label");
  const percentage = (currentTime / totalTime) * 100;
  const labelSeconds = totalTime - currentTime;
  progressBar.css("width", percentage + "%");
  progressLabel.text(`ETA ${labelSeconds.toFixed(2)} sec`);
}


function generateImages() {
  var model_id = $('#selectedBaseModelText').val();
  var prompt = $('#prompt').val();
  var negative_prompt = $('#neg_prompt').val();
  var scheduler_list = $('#scheduler_list').val();
  var vae_model = $('#vaemodelslist').val();
  var interference_input = $('#interference_input').val();
  var seed = $('#seed').val();
  var width = $('#width_input').val();
  var height = $('#height_input').val();
  var samples = $('#samples_input').val();
  var guidance_scale = $('#guidance_input').val();
  var safety_checker = $('#safety_checker').is(':checked');
  var enhance_prompt = $('#enhance_prompt').is(':checked');
  var multi_lingual = $('#multi_lingual').is(':checked');
  var panorama = $('#panorama').is(':checked');
  var self_attention = $('#self_attention').is(':checked');
  var upscale = $('#upscale').is(':checked');
  var tomesd = $('#tomesd').is(':checked');
  var karras_sigmas = $('#karras_sigmas').is(':checked');

  // fance & super resolution 
  var face_enhance = $('#face_enhance').is(':checked');
  var super_resolution = $('#super_resolution').is(':checked');
  var super_resultion_model_id = $('#super_resultion_model_id').val();

  console.log('face_enhance' ,face_enhance );
  console.log('super_resolution' ,super_resolution );


  if ($('#clickskip_checkbox').is(':checked'))  {
      var clickskip = $('#clickskip_input').val();
  } else {
    var clickskip = null
  }

  if ($('#super_resolution').is(':checked'))  {
    face_enhance = true;
    var super_resultion_model_id = $('#super_resultion_model_id').val();
    var super_resultion_scale = $('#superscale_input').val();
  } else {
    var super_resultion_model_id = null;
    var super_resultion_scale = null;
  }

  console.log('prompt',prompt);
  console.log('negative_prompt',negative_prompt);
  


  if(model_id == '' || model_id == undefined || prompt == '' || prompt == undefined || negative_prompt == '' || negative_prompt == undefined){
    $('#error_popup').modal("show");

  }else{

    $('#generateBtn').text('Generating');
    $('#generateBtn').addClass('generating');
    $(".innerImageDiv").find("img").remove();
    $(".server_restart").remove();
    


    //save prompt for last generation 

    localStorage.removeItem('prompt_value');
    localStorage.setItem('prompt_value', $('#prompt').val());

    localStorage.removeItem('neg_prompt_value');
    localStorage.setItem('neg_prompt_value' , $('#neg_prompt').val());


    // runProgressBar(progressBarDuration);

    $.ajax({
      url: '' + baseUrl + '/generate-images',
      method: "POST",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data: {
        model_id: model_id,
        prompt: prompt ,
        negative_prompt: negative_prompt ,
        lora_model: loraModelArray,
        embeddings_model: embeddingModelArray,
        scheduler: scheduler_list,
        vae : vae_model,
        num_inference_steps : interference_input,
        seed : seed,
        clickskip : clickskip,
        face_enhance : face_enhance,
        super_resultion_model_id : super_resultion_model_id,
        super_resultion_scale : super_resultion_scale,
        width : width,
        height : height,
        samples : samples,
        guidance_scale : guidance_scale,
        safety_checker : safety_checker,
        enhance_prompt : enhance_prompt,
        multi_lingual : multi_lingual,
        panorama : panorama,
        self_attention : self_attention,
        upscale : upscale,
        tomesd : tomesd,
        karras_sigmas: karras_sigmas
      },
      success: function (response) {
        
        var response = JSON.parse(response);
        console.log(response);

        if (response.status == "success") {

          $('.hide_progress').css('visibility','visible');
          $('.hide_progress').removeClass('progressheightmanage');
         
          // progressbar interval time start
          const totalTime = response.generationTime; // Total time in seconds
          let currentTime = 0;
            
          const interval = setInterval(function() {
              currentTime += 0.1; // Simulating a fraction of a second
              updateProgressBar(currentTime, totalTime);
              
              if (currentTime >= totalTime) {
                  clearInterval(interval);
                  //$("#progress-label").removeClass("hide_progress").addClass("text-success").text("Completed 100%");
              }
          }, 100); // Update every 100 milliseconds

            // Function to append images
         const etaInSeconds = response.generationTime;   
         function appendSuccessImages() {
              superResolutionArray = [];
              var pageHTML = "<center> <div class='generated_images'>";
              response.output.forEach((element) => {
                superResolutionArray.push(element);
                pageHTML += " <a data-fancybox='images' href='" + element + "'> <img src='" + element + "' alt=''> </a>";
              });
              pageHTML += "</div> </center>";
              
              $(".innerImageDiv").append(pageHTML);
              $(".processing").remove();
              $('#generateBtn').text('Generate');
              $('#generateBtn').removeClass('generating');
              $('.hide_progress').css('visibility','hidden');
              $('.hide_progress').addClass('progressheightmanage');
              if(superResolutionArray.length > 0 ){
                $('#make_super_resolution').removeAttr('disabled');
              }
              console.log("superResolutionArray",superResolutionArray);

         }
         
           // Calculate milliseconds for ETA time
           const etaInMilliseconds = etaInSeconds * 1000;

           // Set timeout to append images after ETA time
           setTimeout(function() {
              appendSuccessImages();
           }, etaInMilliseconds);

         
        }else if(response.status == "processing"){

          $('.hide_progress').css('visibility','visible');
          $('.hide_progress').removeClass('progressheightmanage');
           // progressbar interval time start
           const totalTime = response.eta; // Total time in seconds
           let currentTime = 0;
             
           const interval = setInterval(function() {
               currentTime += 0.1; // Simulating a fraction of a second
               updateProgressBar(currentTime, totalTime);
               
               if (currentTime >= totalTime) {
                   clearInterval(interval);
                   //$("#progress-label").removeClass("hide_progress").addClass("text-success").text("Completed 100%");
               }
           }, 100); // Update every 100 milliseconds
 
             // Function to append images
          const etaInSeconds = response.eta;   
          function appendProcessingImages() {
              superResolutionArray = [];
              var pageHTML = "<center> <div class='generated_images'>";
              response.image_links.forEach((element) => {
                superResolutionArray.push(element);
                pageHTML += " <a data-fancybox='images' href='" + element + "'> <img src='" + element + "' alt=''> </a>";
              });
              pageHTML += "</div> </center>";

              $(".innerImageDiv").append(pageHTML);
              $('#generateBtn').text('Generate');
              $('#generateBtn').removeClass('generating');
              $('.hide_progress').css('visibility','hidden');
              $('.hide_progress').addClass('progressheightmanage');
              if(superResolutionArray.length > 0 ){
                $('#make_super_resolution').removeAttr('disabled');
              }
          }
          
            // Calculate milliseconds for ETA time
            const etaInMilliseconds = etaInSeconds * 1000;

            // Set timeout to append images after ETA time
            setTimeout(function() {
              appendProcessingImages();
            }, etaInMilliseconds);
        }
        else{
          $('#generateBtn').text('Generate');
          $('#generateBtn').removeClass('generating');
          $('.hide_progress').css('visibility','hidden');
          $('.hide_progress').addClass('progressheightmanage');
        }
        // Clear progress bar and label
        // updateProgressBar(0);
      },
      error: function () {
        $("#loader").hide();
        $('.hide_progress').css('visibility','hidden');
        $('.hide_progress').addClass('progressheightmanage');
        $("#result").text("Error occurred while fetching data from the API.");
      },
    });
    
  }

}


//click generate images
$('#generateBtn').on('click', function() {
  var seedvalue = $('#seed').val();
  if(seedvalue > 4294967295){
    $('#error_message_popup').text("");
    $('#error_popup').modal('show');
    $('#error_message_popup').text('Seed must be an integer less than 4294967295');
    return;
  }
  generateImages();
 
});


// make super resoltuion
$('#make_super_resolution').on('click', function(e) {
  e.preventDefault();
  const draggableArea = $('.draggableinputarea');
  const imageUrl = superResolutionArray[0];
  const imageElement = $('<img>').attr('src', imageUrl);
  draggableArea.find('img').remove();
  draggableArea.find('label').hide();
  draggableArea.find('input').hide();
  draggableArea.append(imageElement).addClass('draggable');

  $("#superResolution-tab").tab('show');

  // $('#superResolution-tab a[href="#superResolution"]').tab('show');
});




// click and select in lora popup
$(document).on('click', '.bodyInnerLora', function() {

  if ($(this).hasClass('selectedLoraModel')) {
      $(this).removeClass('selectedLoraModel');
  } else {
      $(this).addClass('selectedLoraModel');
  }
});

// click and select in embedding popup
$(document).on('click', '.bodyInnerEmbedding', function() {

if ($(this).hasClass('selectedEmbeddingModel')) {
  $(this).removeClass('selectedEmbeddingModel');
} else {
  $(this).addClass('selectedEmbeddingModel');
}
});



var loraModelArray = [];
$(document).on('click','.bodyInnerLora',  function() {
    var selectedLoraModel = $(this).attr('data-lora');

    if (!loraModelArray.includes(selectedLoraModel)) {
      // Push the value if it's not already in the array
      loraModelArray.push(selectedLoraModel);

      
    }else{
      let index = loraModelArray.indexOf(selectedLoraModel);
      if (index !== -1) {
        loraModelArray.splice(index, 1);
      }
    }
    
    $(".lora_popup_content").remove();
    loraModelArray.forEach((element) => {
      var pageHTML = "<div class='d-flex lora_popup_content'  data-added-model="+element+">";
      pageHTML += "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 lora_images'>";
      pageHTML += "<img src='"+baseUrl+"/img/icons/placeholder.png' class='img-fluid'>";
      pageHTML += "</div>";
      pageHTML += "<div class='col-lg-10 col-md-10 col-sm-10 col-xs-10 lora_content'>";
      pageHTML += "<div class='spaceBetween'>";
      pageHTML += "<label for=''>"+element+"</label>";
      pageHTML += "<div class='inner'>";
      pageHTML += " <button class='btn btn-success text-light-grey-bg border-radius-7  btn_lora_model_trash' ><img src='"+baseUrl+"/img/icons/trash.png' ></button>";
      pageHTML += "<input type='number'  min='-2' max='2' value='0.8' step='0.1' class='form-control dark-grey border-radius-7 lora_dynamic_input'>";
      pageHTML += "</div>";
      pageHTML += "</div>";

      pageHTML += "<div>";
      pageHTML += "<input type='range'  min='-2' max='2' value='0.8' step='0.1' class='slider lora_dynamic_range' >";
      pageHTML += "</div>";
      pageHTML += "</div>";
      pageHTML += "</div>";
      
      $(".lora_appenddiv").append(pageHTML);
          
    });
    console.log("selectedLoraModel", loraModelArray);
    
    
});


  
$(document).on('input','.lora_dynamic_input', function() {
        $(this).closest('.lora_content').find('.lora_dynamic_range').val($(this).val());
});

$(document).on('input','.lora_dynamic_range', function() {
        $(this).closest('.lora_content').find('.lora_dynamic_input').val($(this).val());
});



//embedding model working events 


var embeddingModelArray = [];
$(document).on('click','.bodyInnerEmbedding',  function() {
    var selectedEmbeddingModel = $(this).attr('data-embedding');

    if (!embeddingModelArray.includes(selectedEmbeddingModel)) {
      // Push the value if it's not already in the array
      embeddingModelArray.push(selectedEmbeddingModel);

      
    }else{
      let index = embeddingModelArray.indexOf(selectedEmbeddingModel);
      if (index !== -1) {
        embeddingModelArray.splice(index, 1);
      }
    }
    
    $(".embedding_popup_content").remove();
    embeddingModelArray.forEach((element) => {
      var pageHTML = "<div class='d-flex embedding_popup_content'  data-added-model="+element+">";
      pageHTML += "<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2 embedding_images'>";
      pageHTML += "<img src='"+baseUrl+"/img/icons/placeholder.png' class='img-fluid'>";
      pageHTML += "</div>";
      pageHTML += "<div class='col-lg-10 col-md-10 col-sm-10 col-xs-10 embedding_content'>";
      pageHTML += "<div class='spaceBetween'>";
      pageHTML += "<label for=''>"+element+"</label>";
      pageHTML += "<div class='inner'>";
      pageHTML += " <button class='btn btn-success text-light-grey-bg border-radius-7  btn_embedding_model_trash' ><img src='"+baseUrl+"/img/icons/trash.png' ></button>";
      pageHTML += "<input type='number'   min='-2' max='2' value='0.8' step='0.1' class='form-control dark-grey border-radius-7 embedding_dynamic_input'>";
      pageHTML += "</div>";
      pageHTML += "</div>";

      pageHTML += "<div>";
      pageHTML += "<input type='range'  min='-2' max='2' value='0.8' step='0.1' class='slider embedding_dynamic_range' >";
      pageHTML += "</div>";
      pageHTML += "</div>";
      pageHTML += "</div>";
      
      $(".embedding_appenddiv").append(pageHTML);
          
    });
    console.log("embeddingModelArray", embeddingModelArray);
    
    
});

$(document).on('input','.embedding_dynamic_input', function() {
  $(this).closest('.embedding_content').find('.embedding_dynamic_range').val($(this).val());
});

$(document).on('input','.embedding_dynamic_range', function() {
  $(this).closest('.embedding_content').find('.embedding_dynamic_input').val($(this).val());
});



//remove dynamic created lora content divs

var reflora;

$(document).on('click', '.btn_lora_model_trash', function() {
   $('#delete_popup_lora').modal('show');
   reflora = $(this).closest('.lora_popup_content');
});

$(document).on('click', '.yeslora', function() {
  var lora_value = $(reflora).attr('data-added-model');
  removeValueFromArray(loraModelArray, lora_value);
  var correspondingElement = $('#lora_model [data-lora="'+lora_value+'"]');
  correspondingElement.removeClass('selectedLoraModel');
  $(reflora).remove(); // Remove the content div
  $('#delete_popup_lora').modal('hide');
});




//remove dynamic created embedding content divs
var refEmbedding;

$(document).on('click', '.btn_embedding_model_trash', function() {
   $('#delete_popup_embedding').modal('show');
   refEmbedding = $(this).closest('.embedding_popup_content');
});

$(document).on('click', '.yesembedding', function() {
  var embedding_value = $(refEmbedding).attr('data-added-model');
  removeValueFromArray(embeddingModelArray, embedding_value);
  var correspondingElement = $('#embedding_model [data-embedding="'+embedding_value+'"]');
  correspondingElement.removeClass('selectedEmbeddingModel');
  $(refEmbedding).remove(); // Remove the content div
  $('#delete_popup_embedding').modal('hide');
});




$('#searchModels').on('keyup', function() {
  const contentDivs = $('div#baseModelsList .col-lg-3');
  const searchText = $(this).val().trim().toLowerCase();

  contentDivs.each(function() {
      const contentText = $(this).find('span').text().toLowerCase();
      if (contentText.includes(searchText)) {
          $(this).show(); // Show the div if text is found
      } else {
          $(this).hide(); // Hide the div if text is not found
      }
  });
});

$('#searchLoraModels').on('keyup', function() {
  const contentDivs = $('div#LoraModelsList .col-lg-3');
  const searchText = $(this).val().trim().toLowerCase();

  contentDivs.each(function() {
      const contentText = $(this).find('span').text().toLowerCase();
      if (contentText.includes(searchText)) {
          $(this).show(); // Show the div if text is found
      } else {
          $(this).hide(); // Hide the div if text is not found
      }
  });
});

$('#searchEmbeddingModels').on('keyup', function() {
  const contentDivs = $('div#EmbeddingsModelsList .col-lg-3');
  const searchText = $(this).val().trim().toLowerCase();

  contentDivs.each(function() {
      const contentText = $(this).find('span').text().toLowerCase();
      if (contentText.includes(searchText)) {
          $(this).show(); // Show the div if text is found
      } else {
          $(this).hide(); // Hide the div if text is not found
      }
  });
});

jQuery('button.clearAllSelect2').on('click', function(){
  $("#prompt_styles").val(null).trigger('change');
}) 

$('#super_resolution').on('change', function() {
  if ($(this).is(':checked')) {
    $('.super_resolution_content').fadeIn(); // Fade in the content
  } else {
    $('.super_resolution_content').fadeOut(); // Fade out the content
  }
});


$('#clickskip_checkbox').on('change', function() {
  if ($(this).is(':checked')) {
    $('#clickskip_input').removeAttr('disabled','false'); 
    $('#clickskip_range').removeAttr('disabled','false'); 
  } else {
    $('#clickskip_input').attr('disabled','true'); 
    $('#clickskip_range').attr('disabled','true'); 
  }
});


$('#seed_dice_btn').on('click', function(){
    var seed_random = generateRandom10Digit();
    localStorage.removeItem('seed_random');
    localStorage.setItem('seed_random',seed_random);
    var sendingValue = -1;
    $('#seed').val(sendingValue);
});


// $('#seed_back_btn').on('click', function(){
//   var seedValue = localStorage.getItem('seed_random');
//   $('#seed').val(seedValue);
// });


$('#clear_prompt').on('click', function(){
  $('#prompt').val("");
  $('#neg_prompt').val("");
});

$('#read_lastgeneration').on('click', function(){

  $('#prompt').val(localStorage.getItem('prompt_value'));
  $('#neg_prompt').val(localStorage.getItem('neg_prompt_value'));

});


$(document).on('click',"#inviteSendBtn" , function() {

  var invite_first_name = $('#invite_firstname').val();
  var invite_lastname = $('#invite_lastname').val();
  var invite_email = $('#invite_email').val();
  var invite_country = $('#invite_country').val();
  var invite_occupation = $('#invite_occupation').val();
  
  $.ajax({
  url: '' + baseUrl + '/sendInvite',
  method: "POST",
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  data: {
    invite_first_name : invite_first_name,
    invite_lastname : invite_lastname,
    invite_email : invite_email,
    invite_country : invite_country,
    invite_occupation : invite_occupation,
  },
  success: function (response) {
      
      var response = response;    
      console.log(response.status);

      if(response.status == "success"){
        $("#invitationUser").modal("hide");
        setTimeout(function(){
            $("#invitemodels-success").modal("show");
        },500);
      }else if(response.status == "failed"){
          $('#invitationError').text("");
          $('#invitationError').text("Invitation already sent!");
          
      }
      else{
        alert("Something went wront!");
      }
      
  },
  error: function () {
      alert("Error occurred while fetching data from the API.");
  },
  });


});


$(document).on('click',"#signUpBtn" , function() {

  var first_name = $('#firstname').val();
  var last_name = $('#lastname').val();
  var email = $('#email').val();

  $.ajax({
  url: '' + baseUrl + '/sendInvite',
  method: "POST",
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  data: {
    first_name : first_name,
    last_name : last_name,
    email : email,
  },
  success: function (response) {
      
      var response = response;    
      console.log(response.status);

      if(response.status == "success"){

        $("#signupModal").modal("hide");
          setTimeout(function(){
            $("#signup-success").modal("show");
          },500);

      }else if(response.status == "failed"){
          $('#RegisterError').text("");
          $('#RegisterError').text("User already registered!");
          
      }
      else{
        alert("Something went wront!");
      }
      
  },
  error: function () {
      alert("Error occurred while fetching data from the API.");
  },
  });

  
});


const Styles = {};
$(document).on('click' ,'#save_style', function () {
  var style_name = $('#style_name').val();
  var model_id = $('#selectedBaseModelText').val();
  var prompt = $('#prompt').val();
  var neg_prompt =  $('#neg_prompt').val();

  console.log(style_name);
  console.log(prompt);

  if (!Styles[style_name]) {
    Styles[style_name] = [];
  }

  Styles[style_name].push(model_id);
  Styles[style_name].push(prompt);
  Styles[style_name].push(neg_prompt);

  $("#prompt_styles").empty();

  for (var style in Styles) {
    var pageHTML = "<option value='" + style + "'>" + style + "</option>";
    $("#prompt_styles").append(pageHTML);
  }

  $('#style_name').val("");
  $('#prompt_style_popup').modal('hide');
  console.log(Styles);

});

function generateRandom10Digit() {
  var minNumber = 1000000000; // Smallest 10-digit number
  var maxNumber = 4294967295; // One less than the maximum value
  var randomNumber = Math.floor(Math.random() * (maxNumber - minNumber + 1)) + minNumber;
  
  // Convert the number to a string and ensure it has 10 digits by padding with leading zeros
  var randomString = randomNumber.toString().padStart(10, '0');
  return randomString;
}

function removeValueFromArray(array, valueToRemove) {
  const index = array.indexOf(valueToRemove);
  if (index !== -1) {
    array.splice(index, 1);
  }
}



