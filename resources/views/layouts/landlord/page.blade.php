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
		<x-landlord.alert-success message="{{ session('success') }}" />
	@endif
	<!-- Form Error Message Box (including Form Validation ) -->
	@if (session('error') || $errors->any())
		<x-landlord.alert-error message="{{ session('error') }}" />
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
							<img class="navbar-brand-logo" src="{{ Storage::disk('s3l')->url('logo/logo-white.svg') }}" alt="Logo" width="60" height="60">
						</a>
						<!-- End Logo -->
					</div>
					<p class="text-white-50">
						A professional package that comes with hundreds of UI components, forms, tables, charts, dashboards, pages and svg icons.
					</p>
					<!-- List -->
					<ul class="list-unstyled ps-0 mb-0 mt-3">
						<li class="mt-1"><a href="#" class="text-white-50"><i class="align-middle me-2 fas fa-fw fa-map-marker-alt"></i> {{ $_config->address1 }}</a></li>
						<li class="mt-1"><a href="#" class="text-white-50">{{ $_config->city.' '.$_config->state.' '. $_config->zip. ', '. $_config->relCountry->name }}</a></li>
						<li class="mt-1"><a href="tel:{{$_config->cell}}" class="text-white-50"><i class="align-middle me-2 fas fa-fw fa-phone"></i> {{ $_config->cell }}</a></li>
					</ul>
					<!-- End List -->
				</div>
				<div class="col-12 col-md-4 col-lg-2 offset-lg-2 mb-3 mb-md-0">
					<h4 class="text-light fs-5">Resources</h4>
					<ul class="list-unstyled ps-0 mb-0 mt-3">
						<li class="mt-2"><a class="text-white-50" href="{{ route('faq') }}"><i class="align-middle far fa-fw fa-user-circle"></i> FAQ</a></li>
						<li class="mt-2"><a class="text-white-50" href="{{ route('login') }}"><i class="align-middle far fa-fw fa-user-circle"></i> Your Account</a></li>
					</ul>
				</div>
				<div class="col-12 col-md-4 col-lg-2 mb-3 mb-md-0">
					<h4 class="text-light fs-5">Legal & Privacy</h4>
					<ul class="list-unstyled ps-0 mb-0 mt-3">
						<li class="mt-2"><a class="text-white-50" href="{{ route('privacy') }}"><i class="align-middle far fa-fw fa-user-circle"></i> Privacy &amp; Policy</a></li>
						<li class="mt-2"><a class="text-white-50" href="{{ route('tos') }}"><i class="align-middle far fa-fw fa-user-circle"></i> Terms of Services</a></li>
						<li class="mt-2"><a class="text-white-50" href="{{ route('contact-us') }}"><i class="align-middle far fa-fw fa-user-circle"></i> Contact us</a></li>
					</ul>
				</div>
				<div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0">

					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for...">
						<button class="btn btn-secondary" type="button">Go!</button>
					</div>
					
					<form class="row row-cols-md-auto align-items-center">
						<div class="col-12">

							<div class="input-group mb-2">
								<div class="input-group-text">@</div>
								<input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
								<button type="submit" class="btn btn-primary mb-2">Submit</button>
							</div>
						</div>
					</form>

					<!-- Form -->
					<form action="{{ route('home.join-mail-list') }}" method="POST">
						@csrf
						<h4 class="text-light fs-5">Stay up to date</h4>
						<!-- Input Card -->
						<div class="input-card mt-3">
							<div class="input-card-form">
								{{-- <input type="text" class="form-control" placeholder="Enter email" aria-label="Enter email"> --}}
								<input name="join_email" id="join_email" type="email" placeholder="you@example.com" aria-label="Enter email"
									class="form-control @error('join_email') is-invalid @enderror"
									value="{{ old('join_email') }}" required>
								@error('join_email')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<button type="submit" class="btn btn-secondary">Submit</button>
						</div>
						<!-- End Input Card -->
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
