<!DOCTYPE html>
<!--
  HOW TO USE:
  data-layout: fluid (default), boxed
  data-sidebar-theme: dark (default), colored, light
  data-sidebar-position: left (default), right
  data-sidebar-behavior: sticky (default), fixed, compact
-->

<html lang="en" data-bs-theme="light" data-layout="fluid"
        data-sidebar-theme="dark"
        data-sidebar-position="left"
        data-sidebar-behavior="sticky">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

    <!-- Title -->
    <title>@yield('title', 'ANYPO.NET')</title>

    <!-- Favicon -->
    {{-- <link rel="shortcut icon" href="./favicon.ico"> --}}
    {{-- <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

	<link rel="canonical" href="https://appstack.bootlab.io/pages-blank.html" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">

</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('home') }}" aria-label="Space">
                    <img class="xxnavbar-brand-logo" src="{{ Storage::disk('s3l')->url('logo/logo-white.svg') }}" alt="Logo" width="80" height="80">
                </a>
				<ul class="sidebar-nav">

                    <!-- ========== SIDEBAR ========== -->
					@if(auth()->user()->isSeeded())
                        @include('landlord.includes.as4-sidebar-back-office')
                    @else
                        @include('landlord.includes.as4-sidebar-front-office')
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
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-lucide="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-lucide="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="pages-settings.html">Settings & Privacy</a>
								<a class="dropdown-item" href="#">Help</a>
								<a class="dropdown-item" href="#">Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

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
