<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} | @yield('title', 'Generate AI Image')</title>
  <meta name="description" content="">
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('img/icons/favicon.ico') }}" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
  <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
  <link href="https://exdiffusion.com/newproject/public/backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
 
  @yield('style')
</head>

<body style="background: #0b0f19;">
  <div class="blur-container">
    @include('partials.frontend.header')

    <div class="mainSection">
      @yield('content')
    </div>

    @include('partials.frontend.footer')


  </div>


  @include('auth.login-modal')
  @include('auth.forget-passwordmodal')
  @include('auth.register-modal')
  @include('frontend.modals.signup-success')
  @include('frontend.modals.upload-models')
  @include('frontend.modals.upload-modelsuccess')
  @include('frontend.modals.invite-modelsuccess')
  @include('frontend.modals.invitation')
  
  @include('frontend.pages.modals')
  
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
  
  <script src="{{ asset('frontend/js/custom.js') }}"> </script>
  <script src="{{ asset('frontend/js/super-resolution.js') }}"> </script>
  <script src="{{ asset('frontend/js/textareaFunctions.js') }}"> </script>
 
  
  @yield('script')
</body>

</html>