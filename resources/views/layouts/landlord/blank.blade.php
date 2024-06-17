<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-layout="fluid" data-sidebar-theme="dark" data-sidebar-position="left" data-sidebar-behavior="sticky">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	 <!-- Title -->
	 {{-- <title>404 Page Not Found | AppStack - Bootstrap 5 Admin &amp; Dashboard Template</title> --}}
	 <title>@yield('title', 'ANYPO.NET')</title>

	 <!-- Favicon -->
	 <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

	<link rel="canonical" href="https://appstack.bootlab.io/auth-404.html" />
	<link rel="shortcut icon" href="img/favicon.ico">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<!-- CSS Front Template -->
	<link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/landlord.css') }}">

</head>

<body>

	<main class="content">
		<div class="container-fluid p-0">

			<!-- content -->
			@yield('content')
			<!-- /.content -->
		</div>
	</main>

	<script src="{{ asset('/assets/js/app.js') }}" type="text/javascript"></script>

</body>

</html>
