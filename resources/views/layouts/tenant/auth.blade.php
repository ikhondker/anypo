<!DOCTYPE html>
<!--
	HOW TO USE:
	data-layout: fluid (default), boxed
	data-sidebar-theme: dark (default), colored, light
	data-sidebar-position: left (default), right
	data-sidebar-behavior: sticky (default), fixed, compact
-->
<html lang="en"
	data-bs-theme="light"
	data-layout="fluid"
	data-sidebar-theme="dark"
	data-sidebar-position="left"
	data-sidebar-behavior="sticky">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="ANYPO.NET - Control Expenses ">
	<meta name="author" content="Iqbal H Khondker">

	<title>@yield('title', 'anypo.net')</title>

	<link rel="canonical" href="https://www.anypo.net/404" />
	<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">


	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<!-- CSS Front Template -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/tenant.css') }}">

</head>

<body>
	<div class="auth-full-page d-flex">
		<div class="auth-form p-3">

			<!-- content -->
			@yield('content')
			<!-- /.content -->

		</div>
	</div>

	{{-- Don't Switch to aws--}}
	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
	{{-- <script	src="{{ Storage::disk('s3t')->url('js/app.js') }}"></script> --}}
</body>

</html>
