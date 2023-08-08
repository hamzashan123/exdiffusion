<!DOCTYPE html>
<html  lang="en">
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
   
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @yield('style')
</head>
<body style="background: #0b0f19;" >
    <div class="blur-container">
        @include('partials.header')

        <div class="mainSection">
            @yield('content')
        </div>

        @include('partials.footer')

        
    </div>

      <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <input type="text" class="form-control searchModelImages" placeholder="Search...">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <!-- Image gallery or list -->
          <div class="row">

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                <div class="bodyInner selectedModel">
                  <img src="{{asset('img/icons/ai1.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
                <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
            <div class="bodyInner">
                  <img src="{{asset('img/icons/ai2.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
              <div class="bodyInner">
                  <img src="{{asset('img/icons/ai3.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
               <div class="bodyInner">
                  <img src="{{asset('img/icons/ai4.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
              <div class="bodyInner">
                  <img src="{{asset('img/icons/ai1.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
                <div class="bodyInner">
                  <img src="{{asset('img/icons/ai2.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
                <div class="bodyInner">
                  <img src="{{asset('img/icons/ai3.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
                <div class="bodyInner">
                  <img src="{{asset('img/icons/ai4.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
              <div class="bodyInner">
                  <img src="{{asset('img/icons/ai1.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
                <div class="bodyInner">
                  <img src="{{asset('img/icons/ai2.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
                <div class="bodyInner">
                  <img src="{{asset('img/icons/ai3.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                
                <div class="bodyInner">
                  <img src="{{asset('img/icons/ai4.png')}}" alt="Image 1" class="img-fluid mb-3">
                </div>
              <span> Girlfriends Mix</span>
            </div>

           
            

            <!-- Add more image columns as needed -->
          </div>
        </div>
      </div>
    </div>
  </div>
    
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
    @yield('script')
</body>
</html>
