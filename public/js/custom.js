$(document).ready(function(){

  getBaseModels();

});


function getBaseModels(){
           
    $("#loader").show();
 
    // // Make an API request
    
    $.ajax({
      url: 'https://exdiffusion.com/newproject/public/get-base-models', // Replace with your API endpoint
      method: "GET",
      data: {

      },
      success: function (response) {
      
        var response = JSON.parse(response);
        
        // console.log('response', response.output);
        if(response.status == "success"){
            $("#container").show();
            $("#loader").hide();   

            console.log(response);


            response.models.forEach((element) => {
                var pageHTML = "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
                pageHTML += "<div class='bodyInner'>";
                pageHTML += "<img src='/img/icons/ai1.png' alt='Image 1' class='img-fluid mb-3'>";
                pageHTML += " </div>";
                pageHTML += " <span> "+element.model_id+"</span>";
                pageHTML += "</div>";
                
                $("#baseModelsList").append(pageHTML);
                    
            });

            response.controlnet_models.forEach((element) => {
              var pageHTML = "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
              pageHTML += "<div class='bodyInnerLora '>";
              pageHTML += "<img src='/img/icons/ai1.png' alt='Image 1' class='img-fluid mb-3'>";
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