<!DOCTYPE html>
<html lang="en" dir="">
<head>
<!-- Required Meta Tags Always Come First -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Title -->
{{-- <title>Account: 11 Preferences | Front - Multipurpose Responsive Template</title> --}}
<title>@yield('title', 'ANYPO.NET')</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">


<!-- Favicon -->
<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ Storage::disk('s3l')->url('vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }}">
<link rel="stylesheet" href="{{ Storage::disk('s3l')->url('vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">

<!-- CSS Front Template -->
<link rel="stylesheet" href="{{ asset('/assets/css/theme.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/landlord.css') }}">


</head>

<body>

	<!-- ========== MAIN CONTENT ========== -->
	<main id="content" role="main" class="">
		 <!-- content -->
		 @yield('content')
		 <!-- /.content -->
	</main>
	<!-- ========== END MAIN CONTENT ========== -->



</body>
</html>
