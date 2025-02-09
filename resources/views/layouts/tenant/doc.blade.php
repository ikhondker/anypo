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
	data-sidebar-theme="colored"
	data-sidebar-position="left"
	data-sidebar-behavior="fixed">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="ANYPO.NET - Control Expenses ">
	<meta name="author" content="Iqbal H Khondker">

	<!-- Title -->
	<title>@yield('title', 'ANYPO.NET')</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

	<link rel="canonical" href="https://www.anypo.net/404" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<!-- CSS Front Template -->
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/tenant.css') }}">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">

				<div class="sidebar-brand">
						<img src="{{ Storage::disk('s3t')->url('logo/logow.png') }}" width="90px" height="90px" class="me-2 mb-2" alt="{{ $_setup->name }}"/>
						<h4 class="text-white">DOCUMENTATION</h4>
				</div>

				<!-- ========== SIDEBAR ========== -->
				@include('tenant.includes.sidebar-doc')
				<!-- ========== END SIDEBAR ========== -->
			</div>
		</nav>
		<div class="main">


			<nav class="navbar navbar-expand navbar-bg">
				{{-- <a class="sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a> --}}

				{{-- <ul class="navbar-nav">
					Documentation
				</ul> --}}

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
					  &nbsp;
					</ul>
				</div>

			</nav>

			<main class="content">
				<div class="container-fluid p-0">

						{{-- <h1 class="h3 mb-3">Blank Page</h1> --}}

						<div class="row">
							<div class="mx-auto col-lg-10 col-xl-8">

							<!-- breadcrumb -->
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item">
										<a href="{{ route('home') }}" class="text-muted"><i class="align-top text-muted" data-lucide="home"></i> Home</a>
									</li>
									@yield('breadcrumb')
								</ol>
							</nav>
							<!-- /.breadcrumb -->

							<div class="row mb-2 mb-xl-3">
								<div class="col-auto d-none d-sm-block">
									<h3 class="mb-3"><i class="align-middle text-muted" data-lucide="grid"></i> @yield('title', config('app.name'))</h3>
								</div>
								<div class="col-auto ms-auto text-end mt-n1">
									{{-- <a href="{{ route('tickets.create') }}" class="btn btn-primary shadow-sm float-end me-1">
										<i class="align-middle" data-lucide="message-square"></i>
									</a> --}}
									<a href="tel:{{ config('akk.SUPPORT_PHONE_NO')}}" class="btn btn-light float-end me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Call Support">
										<i data-lucide="phone-outgoing"></i> Call support {{config('akk.SUPPORT_PHONE_NO')}}
									</a>
									<a href="{{ route('tickets.create') }}" class="btn btn-light float-end me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Create Support Ticket">
										<i data-lucide="message-square"></i> Create Ticket
									</a>
									{{-- <a href="{{ route('docs.index') }}" class="btn btn-info shadow-sm float-end me-1" target="_blank">
										<i class="align-middle" data-lucide="help-circle"></i>
									</a> --}}
								</div>
							</div>
							<!-- content -->
							@yield('content')
							<!-- /.content -->
							</div>
						</div>


					{{-- <div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Empty card</h5>
								</div>
								<div class="card-body">
								</div>
							</div>
						</div>
					</div> --}}

				</div>
			</main>

				<!-- ========== Footer ========== -->
				@include('tenant.includes.footer')
				<!-- ========== End Footer ========== -->

		</div>
	</div>

	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>


</body>

</html>
