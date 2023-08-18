var baseUrl = 'https://exdiffusion.com/newproject/public';
// var baseUrl = 'http://localhost:8000';

$(document).ready(function(){
      getBaseModels(baseUrl);
      getSchedulers(baseUrl);  
});



function getBaseModels(baseUrl){
           
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

function getSchedulers(baseUrl){
           
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
$(document).on('click','.btn_lora_model_trash', function(){
    $(this).closest('.lora_popup_content').remove();
});


//remove dynamic created embedding content divs
$(document).on('click','.btn_embedding_model_trash', function(){
  $(this).closest('.embedding_popup_content').remove();
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
    $('#seed').val(seed_random);
});


$('#seed_back_btn').on('click', function(){
  var seedValue = localStorage.getItem('seed_random');
  $('#seed').val(seedValue);
});


function generateRandom10Digit() {
  let randomNum = '';
  for (let i = 0; i < 10; i++) {
    randomNum += Math.floor(Math.random() * 10);
  }
  return randomNum;
}