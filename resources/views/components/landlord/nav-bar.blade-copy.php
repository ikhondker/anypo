
	<!-- ========== HEADER ========== -->

    <!-- ========== TOP NAV BAR ========== -->
	<nav class="navbar p-2 navbar-expand-md navbar-dark bg-primary landing-navbar">
		<div class="container">
			<ul class="navbar-nav ms-auto">
				<li class="nav-item d-none d-md-inline-block">
					@auth
						<img class="rounded-circle rounded"
							src="{{ Storage::disk('s3l')->url('flags/'. Str::lower($_landlord_user->country).'.png') }}"
							alt="{{ $_landlord_user->country }}" width="32" height="32"
							/>
					@endauth
					@guest
						<img class="rounded-circle me-2" src="{{ Storage::disk('s3l')->url('flags/ca.png') }}"
						alt="CA" width="32" height="32"/>
					@endguest
				</li>
				<li class="nav-item d-none d-md-inline-block">
					@auth
						<a href="{{ route('dashboards.index') }}" class="nav-link active text-lg px-lg-3">
							<i class="align-middle me-2 fas fa-fw fa-chart-pie"></i>
							Dashboard
						</a>
					@endauth
					@guest
						<a href="{{ route('register') }}" class="nav-link active text-lg px-lg-3">
							<i class="align-middle far fa-fw fa-user-circle"></i>
							Register
						</a>
					@endguest
				</li>

				@auth
				<li class="nav-item d-none d-md-inline-block">
					<a href="{{ route('users.show', auth()->user()->id) }}" class="nav-link active text-lg px-lg-3">
						<span class="avatar avatar-xs avatar-circle">
							<img class="avatar-img" src="{{ Storage::disk('s3l')->url('avatar/'.$_landlord_user->avatar) }}" alt="{{ $_landlord_user->name }}" title="{{ $_landlord_user->name }}">
						</span>
						{{ Str::limit(auth()->user()->name, 15, '...') }}
					</a>
				</li>
				<li class="nav-item d-none d-md-inline-block">
					<a href="{{ route('logout') }}" class="nav-link active text-lg px-lg-3">
						<i class="align-middle fas fa-fw fa-power-off" style="color:red;"></i>
						Logout
					</a>
				</li>
				@endauth
				@guest
				<li class="nav-item d-none d-md-inline-block">
						<a href="{{ route('login') }}" class="nav-link active text-lg px-lg-3">
							<i class="align-middle fas fa-fw fa-power-off" ></i>
							Login
						</a>
					</li>
				@endguest

			</ul>
		</div>
	</nav>
	<!-- ========== TOP NAV BAR ========== -->

    <!-- ========== MAIN NAV BAR ========== -->
	<nav class="navbar navbar-expand-md navbar-dark bg-primary landing-navbar">
		<div class="container">

			<!-- Default Logo -->
			<a class="navbar-brand landing-brand text-white" href="{{ route('home') }}" aria-label="aypo.net">
				<img class="navbar-brand-logo" src="{{ Storage::disk('s3l')->url('logo/logo-title.svg') }}" alt="Logo">
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
						href="{{ route('pricing') }}" role="button" aria-expanded="false">Pricing</a>
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

			</ul>
			<a href="{{ route('pricing') }}"
            class="btn btn-lg btn-success btn-pill my-2 my-sm-0 ms-3">Buy now</a>
		</div>
	</nav>
    <!-- ========== MAIN NAV BAR ========== -->

    <!-- ========== HEADER ========== -->
	<header id="header" class="navbar navbar-expand-lg navbar-end navbar-light bg-white">
		<!-- Topbar -->
		<div class="container navbar-topbar">
			<nav class="js-mega-menu navbar-nav-wrap">


				<div id="topbarNavDropdown"
					class="navbar-nav-wrap-collapse collapse navbar-collapse navbar-topbar-collapse">


					<ul class="navbar-nav">
						<!-- Navbar -->
						<span class="avatar avatar-xs avatar-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $_landlord_user->country }}">
							@auth
								<img class="avatar-img" src="{{ Storage::disk('s3l')->url('flags/'. Str::lower($_landlord_user->country).'.png') }}" alt="{{ $_landlord_user->country }}" />
							@endauth
							@guest
								<img class="avatar-img" src="{{ Storage::disk('s3l')->url('flags/ca.png') }}" alt="CA">
							@endguest
						</span>
						<li class="nav-item">
							@auth
								<a href="{{ route('dashboards.index') }}" class="nav-link text-muted">
									<i class="bi bi-speedometer2 nav-icon"></i>
									Dashboard
								</a>
							@endauth
							@guest
								<a href="{{ route('register') }}" class="nav-link text-muted">
									<i class="bi bi-person-circle text-primary"></i>
									Register
								</a>
							@endguest
						</li>
						<!-- End Navbar -->

						@auth
							<li class="nav-item">
								<a href="{{ route('users.show', auth()->user()->id) }}" class="nav-link text-muted">
									<span class="avatar avatar-xs avatar-circle">
										<img class="avatar-img" src="{{ Storage::disk('s3l')->url('avatar/'.$_landlord_user->avatar) }}" alt="{{ $_landlord_user->name }}" title="{{ $_landlord_user->name }}">
									</span>
									{{ Str::limit(auth()->user()->name, 15, '...') }}
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('logout') }}" class="nav-link text-muted">
									<i class="bi bi-power nav-icon text-danger"></i> Logout
								</a>
							</li>
						@endauth
						@guest
							<li class="nav-item">
								<a href="{{ route('login') }}" class="nav-link text-muted">
									<i class="bi bi-power text-primary"></i> Login
								</a>
							</li>
						@endguest

					</ul>
				</div>
			</nav>
		</div>
		<!-- End Topbar -->

		<div class="container">
			<nav class="js-mega-menu navbar-nav-wrap">
				<!-- Default Logo -->
				<a class="navbar-brand" href="{{ route('home') }}" aria-label="aypo.net">
					<img class="navbar-brand-logo" src="{{ Storage::disk('s3l')->url('logo/logo-title.svg') }}" alt="Logo">
				</a>
				<!-- End Default Logo -->

				<!-- Toggler -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
					aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-default">
						<i class="bi-list"></i>
					</span>
					<span class="navbar-toggler-toggled">
						<i class="bi-x"></i>
					</span>
				</button>
				<!-- End Toggler -->

				<!-- Collapse -->
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav">
						<!-- Landings -->
						<li class="nav-item">
							<a id="landingsMegaMenu" class="hs-mega-menu-invoker nav-link {{ $_route_name == 'root' ? 'active' : '' }}" aria-current="page"
								href="{{ route('home') }}" role="button" aria-expanded="false">Home</a>
						</li>
						<!-- End Landings -->

						<!-- Product -->
						<li class="nav-item">
							<a id="companyMegaMenu" class="hs-mega-menu-invoker nav-link {{ $_route_name == 'product' ? 'active' : '' }}"
								href="{{ route('product') }}" role="button" aria-expanded="false">Product</a>
						</li>
						<!-- End Product -->

						<!-- Pricing -->
						<li class="nav-item">
							<a id="accountMegaMenu" class="hs-mega-menu-invoker nav-link {{ $_route_name == 'pricing' ? 'active' : '' }}"
								href="{{ route('pricing') }}" role="button" aria-expanded="false">Pricing</a>
						</li>
						<!-- End Pricing -->

						<!-- FAQ -->
						<li class="nav-item">
							<a id="faqMegaMenu" class="hs-mega-menu-invoker nav-link {{ $_route_name == 'faq' ? 'active' : '' }}"
								href="{{ route('faq') }}" role="button" aria-expanded="false">FAQ</a>
						</li>
						<!-- End FAQ -->

						<!-- Contact -->
						<li class="nav-item">
							<a id="contactMegaMenu" class="hs-mega-menu-invoker nav-link {{ $_route_name == 'contact-us' ? 'active' : '' }}"
								href="{{ route('contact-us') }}" role="button" aria-expanded="false">Contact Us</a>
						</li>
						<!-- End Contact -->

						<!-- Button -->
						<li class="nav-item">
							<a class="btn btn-primary btn-transition"	href="{{ route('pricing') }}">Buy now</a>
						</li>
						<!-- End Button -->

					</ul>
				</div>
				<!-- End Collapse -->
			</nav>
		</div>
	</header>
	<!-- ========== END HEADER ========== -->
