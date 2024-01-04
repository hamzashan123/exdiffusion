<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/icons/favicon.ico') }}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title', 'Dashboard')</title>
    <!-- Fonts -->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/sb-admin-2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/vendor/bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/vendor/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
    <livewire:styles />
    @yield('styles')
</head>

<body id="page-top">

    <div class="loader" id="loader"></div>
    
    <div id="app">
        <div id="wrapper">
            @include('partials.backend.sidebar')
            <div id="content-wrapper" class="d-flex flex-column mainRightContainer">
                <div id="content">
                    @include('partials.backend.navbar')
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @include('partials.backend.flash')
                        @yield('content')
                    </div>
                </div>
                @include('partials.backend.footer')
            </div>
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        @include('partials.backend.modal')
    </div>
    <livewire:scripts />
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <!-- file input -->
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>
    <!-- summernote -->
    <script src="{{ asset('backend/vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')
</body>

</html>