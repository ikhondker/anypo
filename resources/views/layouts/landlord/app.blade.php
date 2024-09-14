<!DOCTYPE html>
<html lang="en"
		data-bs-theme="light"
		data-layout="fluid"
		data-sidebar-theme="dark"
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

	<!-- CSS Template -->
	<link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/landlord.css') }}">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">

				<div class="sidebar-brand">
					@auth
						<a class="" href="{{ route('home') }}">
							<img src="{{ Storage::disk('s3l')->url('logo/logo-white.svg') }}" width="90px" height="90px" class="rounded-circle rounded me-2 mb-2" alt="Logo"/>
						</a>
						<a class="" href="{{ route('users.profile') }}">
							<h6 class="text-muted">[{{ Str::limit(auth()->user()->name, 25, '...') }}]</h6>
						</a>
						<p class="small text-muted m-0 p-0">{{ auth()->user()->email }}</p>
					@endauth
					@guest
						<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" width="90px" height="90px" class="rounded-circle rounded me-2 mb-2" alt="Logo"/>
						<h4 class="text-info">{{ env('APP_NAME') }}</h4>
						<h6 class="text-danger">Guest!</h6>
					@endguest
				</div>

				<ul class="sidebar-nav">

					<!-- ========== SIDEBAR ========== -->
					@if(auth()->user()->isSeeded())
						@include('landlord.includes.sidebar-back-office')
					@else
						@include('landlord.includes.sidebar-front-office')
					@endif
					<!-- ========== END SIDEBAR ========== -->

				</ul>
			</div>
		</nav>
		<div class="main">
			<nav class="navbar navbar-expand navbar-bg">
				<a class="sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">

						<a class="nav-flag dropdown-toggle" href="#" id="flag" data-bs-toggle="no-dropdown">
							<img src="{{ Storage::disk('s3l')->url('flags/'. Str::lower($_landlord_user->country).'.png') }}" alt="{{ $_landlord_user->country }}" />
						</a>


						<li class="nav-item dropdown">

							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
								<i class="align-middle" data-lucide="settings"></i>
							</a>
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="{{ Storage::disk('s3l')->url('avatar/'.$_landlord_user->avatar) }}" class="img-fluid rounded-circle me-1 mt-n2 mb-n2" alt="{{ $_landlord_user->name }}" title="{{ $_landlord_user->name }}" width="40" height="40"/>
								<span>{{ auth()->user()->name }}</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								@auth
									<a class="dropdown-item" href="{{ route('users.profile') }}"><i class="align-middle me-1" data-lucide="user"></i> {{ Str::limit(auth()->user()->name, 18, '...') }}</a>
									<a class="dropdown-item" href="{{ route('users.profile-password') }}"><i class="align-middle me-1" data-lucide="key"></i> Change Password</a>
								@endauth

								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('dashboards.index') }}"><i class="align-middle me-1" data-lucide="pie-chart"></i> Dashboard</a>
								<a class="dropdown-item" href="{{ route('tickets.create') }}"><i class="align-middle me-1" data-lucide="message-square"></i> Support</a>
								<a class="dropdown-item" href="{{ route('logout') }}"><i class="align-middle text-danger me-1" data-lucide="power"></i> Sign out</a>

							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">

				<div class="container-fluid p-0">

					<div class="col-lg-9">
						<!-- Form Success Message Box -->
						@if (session('success'))
							<x-landlord.alerts.app-alert-success message="{{ session('success') }}" />
						@endif
						<!-- Form Error Message Box (including Form Validation ) -->
						@if (session('error') || $errors->any())
							<x-landlord.alerts.app-alert-error message="{{ session('error') }}" />
						@endif
					</div>

					<!-- breadcrumb -->
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><i class="align-top text-muted" data-lucide="home"></i><a href="{{ route('dashboards.index') }}" class="text-muted"> Home</a></li>
							@yield('breadcrumb')
						</ol>
					</nav>
					<!-- /.breadcrumb -->

					<!-- content -->
					@yield('content')
					<!-- /.content -->
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="{{ route('tickets.create') }}">Support</a>
								</li>

								<li class="list-inline-item">
									<a class="text-muted" href="{{ route('privacy') }}">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{ route('tos') }}">Terms of Service</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="{{ route('contact-us') }}">Contact Us</a>
								</li>
							</ul>
						</div>
						<div class="col-6 text-end">
							<p class="mb-0">
								&copy; {{ date('Y') }} <a href="{{ route('home') }}" class="text-muted">{{ env('APP_NAME') }}</a>. All rights reserved.
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	{{-- Don't Switch to aws--}}
	<script src="{{ asset('/assets/js/app.js') }}" type="text/javascript"></script>

</body>

</html>
