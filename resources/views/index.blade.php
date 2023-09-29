<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} | @yield('title', 'Exdiffusion')</title>
  <meta name="description" content="">
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('img/icons/favicon.ico') }}" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
 
</head>

<body style="background: #0b0f19;">
  <div class="blur-container">
   
    <div class="indexSection">
            <div class="row ">
                    <img src="{{asset('img/logo.png')}}" height="50px" width="50px"/>
            </div>
            <div class="row contentSectionIndex">
                    <h2>Unleashing Boundless Creativity in One Platform</h2>
                    <p>Exdiffusion: A pioneering platform where Stable Diffusion meet cutting-edge AI, 
                    offering a holistic solution to craft images, videoes, and sounds. Unleash boundless 
                    creativity with us, all in one place.
                    </p>
                    <h2>Unleash with Exdiffusion</h2>
            </div>
            <div class="row gridSectionIndex">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <a href="#">
                                    
                                        Instant Stable Diffusion
                                    
                                    </a>
                                    <p> Create stunning AI generated images with stable Diffusion, no installation or setup required.  </p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <a href="#">
                                    
                                    Clone, Craft, Customize
                                
                                </a>
                                <p> Easily clone public AI image settings and craft your own customized visuals.  </p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <a href="#">
                                    
                                    Train, Refine, Voice
                                
                                </a>
                                <p> Coming soon: Harness the power of AI to train and refine voice outputs.  </p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <a href="#">
                                    
                                    Voice, Visual, Harmony 
                                
                                </a>
                                <p> Coming soon: Seamlessly combine AI-trained voices with your generated images for a harmonious experience.  </p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <a href="#">
                                    
                                    Image2Video 
                                
                                </a>
                                <p> Coming soon: Transform your AI-generated images into captivating videos. </p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <a href="#">
                                    
                                    ChatGPT-image Fusion
                                
                                </a>
                                    <p> Coming soon: Blend AI imagery with chatGPT. Explore diverse interactive possibillites.  </p>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="row exclusiveAccessRequest">
                    <div class="col-xl-12 col-md-12 mb-4 ">
                    <button  data-bs-toggle="modal" data-bs-target="#invitationUser" class="btn btn-secondary text-light-grey-bg border-radius-7 " fdprocessedid="aq6tyu"><img src="https://exdiffusion.com/newproject/public/img/icons/publish.png"  class="btn_img"> Exclusive Access Request</button>
                    </div>
            </div>

            <div class="form-group donthaveaccount">                   
                        Already have an account?   &nbsp; <a href="{{route('login')}}" class="donthaveaccount" >  Sign in </a>             
            </div>
           
            
        
    </div>

    

  </div>




  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
  <script src="{{ asset('frontend/js/custom.js') }}"> </script>
  <script src="{{ asset('frontend/js/super-resolution.js') }}"> </script>
  <script src="{{ asset('frontend/js/textareaFunctions.js') }}"> </script>
  
    
</body>


@include('frontend.modals.invite-modelsuccess')
@include('frontend.modals.invitation')
</html>