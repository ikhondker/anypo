<!DOCTYPE html>
<html lang="en" dir="">
<head>
	<!-- Required Meta Tags Always Come First -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Title -->
	<title>@yield('title', 'AnyPO.com')</title>

	<!-- Favicon -->
		<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

	<!-- CSS Implementing Plugins -->
	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="{{ asset('/assets/vendor/bootstrap-icons/font/bootstrap-icons.css') }}">

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


	<!-- JS Global Compulsory  -->
	<script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

	<!-- JS Front -->
	<script src="{{ asset('/assets/js/theme.min.js') }}"></script>


</body>
</html>
