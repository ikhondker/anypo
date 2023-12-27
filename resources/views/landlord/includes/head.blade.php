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
{{-- <link rel="stylesheet" href="{{ asset('/assets/vendor/bootstrap-icons/font/bootstrap-icons.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('/assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}"> --}}

{{-- bootstrap icons v1.11.2  --}}
{{-- <link rel="stylesheet" href="{{ Storage::disk('s3l')->url('vendor/bootstrap-icons/font/bootstrap-icons.css') }}"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
<link rel="stylesheet" href="{{ Storage::disk('s3l')->url('vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }}">
<link rel="stylesheet" href="{{ Storage::disk('s3l')->url('vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">

<!-- CSS Front Template -->
{{-- <link rel="stylesheet" href="{{ asset('/assets/css/theme.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('/assets/css/landlord.css') }}"> --}}
<link rel="stylesheet" href="{{ Storage::disk('s3l')->url('css/theme.css') }}">
<link rel="stylesheet" href="{{ Storage::disk('s3l')->url('css/landlord.css') }}">

{{-- <script	src="https://code.jquery.com/jquery-3.7.0.min.js"
	integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
	crossorigin="anonymous">
</script> --}}
    
{{-- jquery v3.7.1 --}}
{{-- <script	src="{{ asset('/assets/js/jquery-3.7.1.min.js') }}"></script> --}}
<script	src="{{ Storage::disk('s3l')->url('js/jquery-3.7.1.min.js') }}"></script>

{{-- sweetalert2 v11.7.27 --}}
{{-- <script	src="{{asset('/assets/js/sweetalert2.min.js')}}"></script> --}}
{{-- <script	src="{{ Storage::disk('s3l')->url('js/sweetalert2.min.js') }}"></script> --}}
{{-- <link rel="stylesheet" href="{{asset('/assets/css/sweetalert2.min.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{ Storage::disk('s3l')->url('css/sweetalert2.min.css') }}"> --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" >
