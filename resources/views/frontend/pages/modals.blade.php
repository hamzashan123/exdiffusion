<!-- BaseModels Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control searchModelImages" id="searchModels" placeholder="Search...">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Image gallery or list -->
          <div class="row" id="baseModelsList">



            <!-- Add more image columns as needed -->
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Lora Modal -->
  <div class="modal fade" id="lora_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control searchModelImages" id="searchLoraModels" placeholder="Search...">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Image gallery or list -->
          <div class="row" id="LoraModelsList">


            <!-- Add more image columns as needed -->
          </div>
        </div>
      </div>
    </div>
  </div>


   <!-- Embedding Modal -->
   <div class="modal fade" id="embedding_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control searchModelImages" id="searchEmbeddingModels" placeholder="Search...">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Image gallery or list -->
          <div class="row" id="EmbeddingsModelsList">


            <!-- Add more image columns as needed -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Save Style Modal -->
  <div class="modal fade" id="prompt_style_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-body">

          <label for="for" class="text-white">Style Name</label>
          <input type="text" class="form-control dark-grey border-radius-7" id="style_name" placeholder="Enter style name">

          <div class="d-flex justify-content-center align-items-center mb-3 mt-3">
            <button type="button" id="save_style" class="btn btn-success form-control text-light-grey-bg border-radius-7">Save</button>
            <button type="button" class="btn btn-success form-control text-light-grey-bg border-radius-7" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
         
        </div>
      </div>
    </div>
  </div>


  <!--Delete Lora Yes No -->
  <div class="modal fade" id="delete_popup_lora" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-body">

          <label for="for" class="text-white text-center">Are you sure you want to delete?</label>
          

          <div class="d-flex justify-content-center align-items-center mb-3 mt-3">
            <button type="button" class="btn btn-success form-control text-light-grey-bg border-radius-7 yeslora">Yes</button>
            <button type="button" class="btn btn-success form-control text-light-grey-bg border-radius-7" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>


   <!--Delete Embedding Yes No -->
   <div class="modal fade" id="delete_popup_embedding" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-body">

          <label for="for" class="text-white text-center">Are you sure you want to delete?</label>
          

          <div class="d-flex justify-content-center align-items-center mb-3 mt-3">
            <button type="button" class="btn btn-success form-control text-light-grey-bg border-radius-7 yesembedding">Yes</button>
            <button type="button" class="btn btn-success form-control text-light-grey-bg border-radius-7" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

    <!--Error  Modal -->
    <div class="modal fade" id="error_popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <label for="for" class="text-white text-center" id="error_message_popup">Base Model , Prompt and Negative Prompt shouldn't empty!. </label>
          <div class="d-flex justify-content-center align-items-center mb-3 mt-3">
            <button type="button" class="btn btn-success form-control text-light-grey-bg border-radius-7" data-bs-dismiss="modal" aria-label="Close">Okay</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>