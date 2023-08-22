<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} | @yield('title', 'ExDiffusion')</title>
  <meta name="description" content="">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  @yield('style')
</head>

<body style="background: #0b0f19;">
  <div class="blur-container">
    @include('partials.header')

    <div class="mainSection">
      @yield('content')
    </div>

    @include('partials.footer')


  </div>

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
          <input type="text" class="form-control dark-grey border-radius-7" id="" placeholder="Enter style name">

          <div class="d-flex justify-content-center align-items-center mb-3 mt-3">
            <button type="button" class="btn btn-success form-control text-light-grey-bg border-radius-7">Save</button>
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
          <label for="for" class="text-white text-center" >Base Model , Prompt and Negative Prompt shouldn't empty!. </label>
          <div class="d-flex justify-content-center align-items-center mb-3 mt-3">
            <button type="button" class="btn btn-success form-control text-light-grey-bg border-radius-7" data-bs-dismiss="modal" aria-label="Close">Okay</button>
          </div>
          
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
  <script src="{{ asset('js/custom.js') }}"> </script>
  <script src="{{ asset('js/textareaFunctions.js') }}"> </script>
  @yield('script')
</body>

</html>