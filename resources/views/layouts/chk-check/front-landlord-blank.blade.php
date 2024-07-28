<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<!-- Required Meta Tags Always Come First -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Title -->
	<title>@yield('title', 'ANYPO.NETs')</title>

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

	<!-- CSS Implementing Plugins -->
	{{-- <link rel="stylesheet" href="{{ asset('/assets/vendor/bootstrap-icons/font/bootstrap-icons.css') }}"> --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">

	<!-- CSS Front Template -->
	{{-- <link rel="stylesheet" href="{{ asset('/assets/css/theme.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/landlord.css') }}"> --}}
	<link rel="stylesheet" href="{{ Storage::disk('s3l')->url('css/theme.css') }}">
	<link rel="stylesheet" href="{{ Storage::disk('s3l')->url('css/landlord.css') }}">

</head>

<body>
	<!-- ========== MAIN CONTENT ========== -->
	<main id="content" role="main">
			<!-- content -->
			@yield('content')
			<!-- /.content -->
	</main>
	<!-- ========== END MAIN CONTENT ========== -->


	<!-- JS Global Compulsory -->
	{{-- <script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script> --}}
	<script	src="{{ Storage::disk('s3l')->url('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

	<!-- JS Front -->
	{{-- <script src="{{ asset('/assets/js/theme.min.js') }}"></script> --}}
	<script	src="{{ Storage::disk('s3l')->url('js/theme.min.js') }}"></script>


</body>
</html>
