<!-- Required Meta Tags Always Come First -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Title -->
{{-- <title>Account: 11 Preferences | Front - Multipurpose Responsive Template</title> --}}
<title>@yield('title', 'ANYPO.NET')</title>

<!-- Favicon -->
{{-- <link rel="shortcut icon" href="./favicon.ico"> --}}
{{-- <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> --}}
<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

	
<!-- CSS Implementing Plugins -->
{{-- <link rel="stylesheet" href="{{ asset('/assets/vendor/bootstrap-icons/font/bootstrap-icons.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('/assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}"> --}}

{{-- bootstrap icons v1.11.3 --}}
{{-- <link rel="stylesheet" href="{{ Storage::disk('s3l')->url('vendor/bootstrap-icons/font/bootstrap-icons.css') }}"> --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous"> --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ Storage::disk('s3l')->url('vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }}">
<link rel="stylesheet" href="{{ Storage::disk('s3l')->url('vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">

<!-- CSS Front Template -->
<link rel="stylesheet" href="{{ asset('/assets/css/theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/landlord.css') }}">
{{-- <link rel="stylesheet" href="{{ Storage::disk('s3l')->url('css/theme.min.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ Storage::disk('s3l')->url('css/landlord.css') }}"> --}}