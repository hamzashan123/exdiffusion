
const pos_prompt = document.getElementById('prompt');

pos_prompt.addEventListener('input', function () {
    this.style.height = '0';    
    this.style.height = this.scrollHeight + 'px';
});


const neg_prompt = document.getElementById('neg_prompt');

neg_prompt.addEventListener('input', function () {
    this.style.height = '0';    
    this.style.height = this.scrollHeight + 'px';
});


jQuery('button.clearAllSelect2').on('click', function(){
  $("#prompt_styles").val(null).trigger('change');
}) 


$(document).ready(function(){

  getBaseModels();

  const searchModels = $('#searchModels');
     // Select all divs with class 'content'

      searchModels.on('keyup', function() {
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

});


function getBaseModels(){
           
    $("#loader").show();
 
    // // Make an API request
    
    $.ajax({
      //url: '/get-base-models', // Replace with your API endpoint
      url: 'https://exdiffusion.com/newproject/public/get-base-models', // Replace with your API endpoint
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
                pageHTML += "<img src='/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
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

            response.controlnet_models.forEach((element) => {
              var pageHTML = "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
              pageHTML += "<div class='bodyInnerLora '>";
              pageHTML += "<img src='/img/icons/placeholder.png' alt='Image 1' class='img-fluid mb-3'>";
              pageHTML += " </div>";
              pageHTML += " <span> "+element.model_id+"</span>";
              pageHTML += "</div>";
              
              $("#LoraModelsList").append(pageHTML);
                  
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