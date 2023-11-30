<!-- Required Meta Tags Always Come First -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Title -->
{{-- <title>Account: 11 Preferences | Front - Multipurpose Responsive Template</title> --}}
<title>@yield('title', 'AnyPO.com')</title>

<!-- Favicon -->
{{-- <link rel="shortcut icon" href="./favicon.ico"> --}}
{{-- <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> --}}
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">


<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

<!-- CSS Implementing Plugins -->
<link rel="stylesheet" href="{{ asset('/assets/vendor/bootstrap-icons/font/bootstrap-icons.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">

<!-- CSS Front Template -->
<link rel="stylesheet" href="{{ asset('/assets/css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/landlord.css') }}">

{{-- <script	src="https://code.jquery.com/jquery-3.7.0.min.js"
	integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
	crossorigin="anonymous">
</script> --}}
    
{{-- jquery v3.7.1 --}}
<script	src="{{asset('/assets/js/jquery-3.7.1.min.js')}}"></script>

{{-- sweetalert2 v11.7.27 --}}
<script	src="{{asset('/assets/js/sweetalert2.min.js')}}"></script>
<link href="{{asset('/assets/css/sweetalert2.min.css')}}" rel="stylesheet">