var baseUrl = 'https://exdiffusion.com/newproject/public';
// var baseUrl = 'http://localhost:8000';

$(document).ready(function(){
      getBaseModels();
      getSchedulers();  


      $("[data-fancybox]").fancybox({
        // Customize options here
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


          
        // }
   
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

function updateProgressBar(percent) {
  const progressBar = document.getElementById("progress-bar");
  const progressLabel = document.getElementById("progress-label");
  
  progressBar.style.width = percent + "%";
  progressLabel.textContent = "Completed " + percent + "%";
}

function runProgressBar(duration) {
  const startTime = performance.now();
  const interval = 100; // Update interval in milliseconds

  function animate() {
      const currentTime = performance.now();
      const elapsed = currentTime - startTime;
      const percent = Math.min(Math.round((elapsed / duration) * 100), 100);
      if(percent < 90){
        updateProgressBar(percent);
      }
     

      if (percent < 100) {
          requestAnimationFrame(animate);
      }
  }

  animate();
}


$('#restart_server').on('click' , function(){
  $.ajax({
    url: '' + baseUrl + '/restart',
    method: "POST",
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {
    
    },
    success: function (response) {
      
      var response = JSON.parse(response);

      $(".server_restart").empty();
      var pageHTML = "<div class='server_restart'> <p> "+ response.message+"</p> </div>";
             
      $(".innerImageDiv").append(pageHTML);
      console.log(response);
    },
    error: function () {
      $("#loader").hide();
      $('.hide_progress').css('visibility','hidden');
      $("#result").text("Error occurred while fetching data from the API.");
    },
  });
});

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
  const progressBarDuration = 10000; // 5 seconds in milliseconds

  if(model_id == '' || model_id == undefined || prompt == '' || prompt == undefined || negative_prompt == '' || negative_prompt == undefined){
    $('#error_popup').modal("show");

  }else{

    $('#generateBtn').text('Generating');
    $('#generateBtn').addClass('generating');
    $(".innerImageDiv").find("img").remove();
    $('.hide_progress').css('visibility','visible');


    //save prompt for last generation 

    localStorage.removeItem('prompt_value');
    localStorage.setItem('prompt_value', $('#prompt').val());

    localStorage.removeItem('neg_prompt_value');
    localStorage.setItem('neg_prompt_value' , $('#neg_prompt').val());


    runProgressBar(progressBarDuration);

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
          updateProgressBar(100);
          if (response.output) {
          
            response.output.forEach((element) => {
              
              var pageHTML = " <a data-fancybox='images' href='" + element + "'> <img src='" + element + "' alt=''> </a>";
             
              $(".innerImageDiv").append(pageHTML);
             
            });
            $('#generateBtn').text('Generate');
            $('#generateBtn').removeClass('generating');
            $('.hide_progress').css('visibility','hidden');
          }
        }else if(response.status == "processing"){

          $(".processing").remove();
          $('#generateBtn').text('Generate');
          $('#generateBtn').removeClass('generating');
          $('.hide_progress').css('visibility','hidden');

          

         
          var pageHTML = "<div class='processing'>";
          pageHTML += "<span>"+ response.tip+"</span>";
          pageHTML += "<br>";
          response.image_links.forEach((element) => {
            pageHTML += " <a target='_blank' href='" + element + "'> "+element+"</a>";
            
          });
        
          pageHTML += "</div>";
          $(".innerImageDiv").append(pageHTML);
        }
        else{
          $('#generateBtn').text('Generate');
          $('#generateBtn').removeClass('generating');
          $('.hide_progress').css('visibility','hidden');
        }
        // Clear progress bar and label
        // updateProgressBar(0);
      },
      error: function () {
        $("#loader").hide();
        $('.hide_progress').css('visibility','hidden');
        $("#result").text("Error occurred while fetching data from the API.");
      },
    });
    
  }

}



function getSuperResolutionImage(ImageLink){

}

//click generate images
$('#generateBtn').on('click', function() {

  generateImages();
 
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