<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	@include('landlord.includes.head')
</head>
<body>

	<x-landlord.nav-bar />
	
	<!-- ========== MAIN CONTENT ========== -->
	<main id="content" role="main" class="bg-light">

		<!-- Breadcrumb -->
		<div class="navbar-dark bg-dark" style="background-image: url('{{asset('/assets/bg/wave-pattern-light.svg')}}');">
		
			<div class="container content-space-1 content-space-b-lg-3">
				<div class="row align-items-center">
					<div class="col">
						<div class="d-none d-lg-block">
							<h1 class="h2 text-white">@yield('title', 'anypo.net')</h1>
						</div>

						<!-- Breadcrumb -->
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb breadcrumb-light mb-0">
								<li class="breadcrumb-item"><i class="bi bi-house-door-fill"></i><a class="text-white"
										href="{{ route('home') }}"> Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb', 'anypo.net')</li>
							</ol>
						</nav>
						<!-- End Breadcrumb -->
					</div>
					<!-- End Col -->

					<div class="col-auto">
						<div class="d-none d-lg-block">
							<a class="btn btn-soft-light btn-sm" href="{{ route('logout') }}"><i class="bi bi-power text-danger"></i> Logout</a>
						</div>

						<!-- Responsive Toggle Button -->
						<button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
							data-bs-target="#sidebarNav" aria-controls="sidebarNav" aria-expanded="false"
							aria-label="Toggle navigation">
							<span class="navbar-toggler-default">
								<i class="bi-list"></i>
							</span>
							<span class="navbar-toggler-toggled">
								<i class="bi-x"></i>
							</span>
						</button>
						<!-- End Responsive Toggle Button -->
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Breadcrumb -->

		<!-- Content Section -->
		<div class="container content-space-1 content-space-t-lg-0 content-space-b-lg-2 mt-lg-n10">
			<div class="row">
				<div class="col-lg-3">
					<!-- Navbar -->
					<div class="navbar-expand-lg navbar-light">
						<div id="sidebarNav" class="collapse navbar-collapse navbar-vertical">
							<!-- Card -->
							<div class="card flex-grow-1 mb-5">
								<div class="card-body">

									<!-- Avatar -->
									<div class="d-none d-lg-block text-center mb-5">
										<div class="avatar avatar-xxl avatar-circle mb-3">
											<img class="avatar-img" src="{{ Storage::disk('s3l')->url('avatar/'.$_landlord_user->avatar) }}" alt="{{ $_landlord_user->name }}" title="{{ $_landlord_user->name }}">
											<img class="avatar-status avatar-lg-status"
												src="{{ Storage::disk('s3l')->url('svg/illustrations/top-vendor.svg') }}"
												alt="Image Description" data-bs-toggle="tooltip" data-bs-placement="top"
												title="Verified user">
										</div>

										@auth
											<h4 class="card-title mb-0">{{ auth()->user()->name }}</h4>
											<p class="card-text small">{{ auth()->user()->email }}</p>
										@endauth
										@guest
											<h4 class="card-title mb-0">Guest</h4>
											<p class="card-text small">you@example.com</p>
										@endguest

										@if (auth()->user()->isSeeded())
											<span class="badge bg-danger">BACK OFFICE</span>
										@endif
									</div>
									<!-- End Avatar -->

									<!-- ========== SIDEBAR ========== -->
									@if(auth()->user()->isSeeded()) 
										@include('landlord.includes.sidebar-back-office')
									@else
										@include('landlord.includes.sidebar-front-office')
									@endif 
									<!-- ========== END SIDEBAR ========== -->
								</div>
							</div>
							<!-- End Card -->
						</div>
					</div>
					<!-- End Navbar -->
				</div>
				<!-- End Col -->

				<div class="col-lg-9">
					<!-- Form Success Message Box -->
					@if (session('success'))
						<x-landlord.app-alert-success message="{{ session('success') }}" />
					@endif
					<!-- Form Error Message Box (including Form Validation ) -->
					@if (session('error') || $errors->any())
						<x-landlord.app-alert-error message="{{ session('error') }}" />
					@endif

					<!-- content -->
					@yield('content')
					<!-- /.content -->
				</div>

				<!-- End Col -->
			</div>
			<!-- End Row -->
		</div>
		<!-- End Content Section -->

	</main>
	<!-- ========== END MAIN CONTENT ========== -->

	<!-- ========== FOOTER ========== -->
	@include('landlord.includes.footer')
	<!-- ========== END FOOTER ========== -->
</body>

</html>
