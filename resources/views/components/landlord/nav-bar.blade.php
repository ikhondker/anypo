
	<!-- ========== HEADER ========== -->

	<!-- ========== TOP NAV BAR ========== -->
	{{-- <nav class="navbar p-2 navbar-expand-md navbar-dark bg-primary landing-navbar"> --}}
	<nav class="navbar navbar-expand-md navbar-dark bg-dark landing-navbar pb-0">
		<div class="container">
			<ul class="navbar-nav ms-auto">
				<li class="nav-item d-none d-md-inline-block">
					@auth
						<a class="nav-flag dropdown-toggle" href="#" id="flag" data-bs-toggle="no-dropdown">
							<img src="{{ Storage::disk('s3l')->url('flags/'. Str::lower($_landlord_user->country).'.png') }}" alt="{{ $_landlord_user->country }}" />
						</a>
					@endauth
					@guest
						<a class="nav-flag dropdown-toggle" href="#" id="flag" data-bs-toggle="no-dropdown">
							<img src="{{ Storage::disk('s3l')->url('flags/ca.png') }}" alt="CA" />
						</a>
					@endguest
				</li>
				<li class="nav-item d-none d-md-inline-block">
					@auth
						<a href="{{ route('dashboards.index') }}" class="nav-link active px-lg-3">
							<i data-lucide="chart-pie" class="align-middle me-1"></i>Dashboard
						</a>
					@endauth
					@guest
						<a href="{{ route('register') }}" class="nav-link active text-lg px-lg-3">
							<i data-lucide="circle-user-round" class="align-middle me-1"></i>Register
						</a>
					@endguest
				</li>

				@auth
				<li class="nav-item d-none d-md-inline-block">
					<a href="{{ route('users.show', auth()->user()->id) }}" class="nav-link active px-lg-3">
							<img class="img-fluid rounded-circle" src="{{ Storage::disk('s3l')->url('avatar/'.$_landlord_user->avatar) }}"
							alt="{{ $_landlord_user->name }}" title="{{ $_landlord_user->name }}"
							width="24" height="24"
							/>
						{{ Str::limit(auth()->user()->name, 15, '...') }}
					</a>
				</li>
				<li class="nav-item d-none d-md-inline-block">
					<a href="{{ route('logout') }}" class="nav-link active px-lg-3">
						<i data-lucide="power" class="align-middle text-danger me-1"></i>Logout
					</a>
				</li>
				@endauth
				@guest
				<li class="nav-item d-none d-md-inline-block">
						<a href="{{ route('login') }}" class="nav-link active text-lg px-lg-3">
							<i data-lucide="power" class="align-middle me-1"></i>
							Login
						</a>
					</li>
				@endguest

			</ul>
		</div>
	</nav>
	<!-- ========== TOP NAV BAR ========== -->

	<!-- ========== MAIN NAV BAR ========== -->
	{{-- <nav class="navbar navbar-expand-md navbar-dark bg-primary landing-navbar"> --}}
	<nav class="navbar navbar-expand-md navbar-dark bg-dark landing-navbar pt-0 pb-0">
		<div class="container">

			<!-- Default Logo -->
			<a class="navbar-brand landing-brand text-white" href="{{ route('home') }}" aria-label="anypo.net">
				<img class="navbar-brand-logo" src="{{ Storage::disk('s3l')->url('logo/logow.svg') }}" width="90" height="90" alt="Logo">
			</a>
			<!-- End Default Logo -->

			<ul class="navbar-nav ms-auto">

				<li class="nav-item d-none d-md-inline-block">
					<a class="nav-link active text-lg px-lg-3 {{ $_route_name == 'root' ? 'active' : '' }}" aria-current="page"
						href="{{ route('home') }}" role="button" aria-expanded="false">Home</a>
				</li>
				<!-- End Landings -->

				<!-- Product -->
				<li class="nav-item d-none d-md-inline-block">
					<a class="nav-link active text-lg px-lg-3 {{ $_route_name == 'product' ? 'active' : '' }}"
						href="{{ route('product') }}" role="button" aria-expanded="false">Product</a>
				</li>
				<!-- End Product -->
				 <!-- Pricing -->
				<li class="nav-item d-none d-md-inline-block">
					<a class="nav-link active text-lg px-lg-3 {{ $_route_name == 'pricing' ? 'active' : '' }}"
						href="{{ route('akk.pricing') }}" role="button" aria-expanded="false">Pricing</a>
				</li>
				<!-- End Pricing -->

				<!-- FAQ -->
				<li class="nav-item d-none d-md-inline-block">
					<a class="nav-link active text-lg px-lg-3 {{ $_route_name == 'faq' ? 'active' : '' }}"
						href="{{ route('faq') }}" role="button" aria-expanded="false">FAQ</a>
				</li>
				<!-- End FAQ -->

				<!-- Contact -->
				<li class="nav-item d-none d-md-inline-block">
					<a class="nav-link active text-lg px-lg-3 {{ $_route_name == 'contact-us' ? 'active' : '' }}"
						href="{{ route('contact-us') }}" role="button" aria-expanded="false">Contact</a>
				</li>
				<!-- End Contact -->

				<!-- Contact -->
				<li class="nav-item d-none d-md-inline-block">
					<a href="{{ route('akk.pricing') }}" class="btn btn-lg btn-success btn-pill my-2 my-sm-0 ms-3">Buy now</a>
				</li>
				<!-- End Contact -->
			</ul>

		</div>
	</nav>
	<!-- ========== MAIN NAV BAR ========== -->

	<!-- ========== END HEADER ========== -->
