<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="ANYPO.NET - Control Expenses ">
	<meta name="author" content="Iqbal H Khondker">

	<!-- Title -->
	<title>@yield('title', 'ANYPO.NET')</title>

	<!-- Favicon -->
	{{-- <link rel="shortcut icon" href="./favicon.ico"> --}}
	{{-- <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> --}}
	<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

	<link rel="canonical" href="https://www.anypo.net/404" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	{{-- <link href="css/app.css" rel="stylesheet"> --}}

	<!-- CSS Front Template -->
	<link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('/assets/css/landlord.css') }}">
</head>

<body>

	<x-landlord.nav-bar />

	<!-- Form Success Message Box -->
	@if (session('success'))
		<x-landlord.alerts.alert-success message="{{ session('success') }}" />
	@endif
	<!-- Form Error Message Box (including Form Validation ) -->
	@if (session('error') || $errors->any())
		<x-landlord.alerts.alert-error message="{{ session('error') }}" />
	@endif


	<!-- content -->
	@yield('content')
	<!-- /.content -->

	<footer class="py-5 bg-dark">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12 col-lg-3">
					<div class="mb-3">
						<!-- Logo -->
						<a class="navbar-brand" href="{{ route('home') }}" aria-label="Space">
							<img class="navbar-brand-logo" src="{{ Storage::disk('s3l')->url('logo/logo-whitet.svg') }}" width="60" height="60" alt="Logo">
						</a>
						<!-- End Logo -->
					</div>
					{{-- <p class="text-white-50">
						Purchasing and Expense Control SAAS Solution for SME and startups.
					</p> --}}
					<!-- List -->
					<ul class="list-unstyled ps-0 mb-0 mt-3">
						<li class="mt-1"><a href="#" class="text-white-50"><i data-lucide="map-pin" class="align-middle me-2"></i> {{ $_config->address1 }}</a></li>
						<li class="mt-1"><a href="#" class="text-white-50">{{ $_config->city.' '.$_config->state.' '. $_config->zip. ', '. $_config->relCountry->name }}</a></li>
						<li class="mt-1"><a href="tel:{{ $_config->cell}}" class="text-white-50"><i data-lucide="phone" class="align-middle me-2"></i> {{ $_config->cell }}</a></li>
					</ul>
					<!-- End List -->
				</div>
				<div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
					<h4 class="text-light fs-5">Resources</h4>
					<ul class="list-unstyled ps-0 mb-0 mt-3">
						<li class="mt-2"><a class="text-white-50" href="{{ route('faq') }}"><i data-lucide="circle-help" class="align-middle"></i> FAQ</a></li>
						<li class="mt-2"><a class="text-white-50" href="{{ route('login') }}"><i data-lucide="circle-user-round" class="align-middle"></i> Your Account</a></li>
						<li class="mt-2"><a class="text-white-50" href="{{ route('request-demo') }}"><i data-lucide="layout-grid" class="align-middle"></i> Request Demo</a></li>
						<li class="mt-2"><a class="text-white-50" href="{{ route('contact-us') }}"><i data-lucide="mail-question" class="align-middle"></i> Contact us</a></li>
 					</ul>
				</div>
				<div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
					<h4 class="text-light fs-5">Legal & Privacy</h4>
					<ul class="list-unstyled ps-0 mb-0 mt-3">
						<li class="mt-2"><a class="text-white-50" href="{{ route('privacy') }}"><i data-lucide="receipt-text" class="align-middle"></i> Privacy &amp; Policy</a></li>
						<li class="mt-2"><a class="text-white-50" href="{{ route('tos') }}"><i data-lucide="receipt-text" class="align-middle"></i> Terms of Services</a></li>
						<li class="mt-2"><a class="text-white-50" href="{{ route('bug-report') }}"><i data-lucide="bug" class="align-middle"></i> Report a Bug</a></li>

					</ul>
				</div>
				<div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
					<h4 class="text-light fs-5">Stay up to date</h4>

					<!-- Form -->
					<form action="{{ route('home.join-mail-list') }}" method="POST">
						@csrf
						<div class="input-group">
							<input name="join_email" id="join_email" type="email" placeholder="you@example.com" aria-label="Enter email"
										class="form-control @error('join_email') is-invalid @enderror"
										value="{{ old('join_email') }}" required>
									@error('join_email')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
							<button type="submit" class="btn btn-secondary">Go!</button>
						</div>
					</form>
					<!-- End Form -->

					<p class="text-white-50">Product new features or big discounts. We never spam.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p class="text-white-50 mt-4 text-center mb-0">

						<p class="text-white-50 small mb-0">&copy; {{ date('Y').' '. env('APP_NAME') }}. All rights reserved.
							@auth
								@if (auth()->user()->isSystem())
									Laravel v{{ app()->version() }} (PHP v{{ phpversion() }})
								@endif
							@endauth
						</p>
					</p>
				</div>
			</div>
		</div>
	</footer>

	<script src="{{ asset('/assets/js/app.js') }}" type="text/javascript"></script>

</body>

</html>
