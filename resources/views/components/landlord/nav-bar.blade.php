	<!-- ========== HEADER ========== -->
	<header id="header" class="navbar navbar-expand-lg navbar-end navbar-light bg-white">
		<!-- Topbar -->
		<div class="container navbar-topbar">
			<nav class="js-mega-menu navbar-nav-wrap">
				<!-- Toggler -->
				<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
					data-bs-target="#topbarNavDropdown" aria-controls="topbarNavDropdown" aria-expanded="false"
					aria-label="Toggle navigation">
					<span class="d-flex justify-content-between align-items-center small">
						<span class="navbar-toggler-text">Topbar</span>
	
						<span class="navbar-toggler-default">
							<i class="bi-chevron-down ms-2"></i>
						</span>
						<span class="navbar-toggler-toggled">
							<i class="bi-chevron-up ms-2"></i>
						</span>
					</span>
				</button>
				<!-- End Toggler -->
	
				<div id="topbarNavDropdown"
					class="navbar-nav-wrap-collapse collapse navbar-collapse navbar-topbar-collapse">
					<div class="navbar-toggler-wrapper">
						<div class="navbar-topbar-toggler d-flex justify-content-between align-items-center">
							<span class="navbar-toggler-text small">Topbar</span>
	
							<!-- Toggler -->
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
								data-bs-target="#topbarNavDropdown" aria-controls="topbarNavDropdown" aria-expanded="false"
								aria-label="Toggle navigation">
								<i class="bi-x"></i>
							</button>
							<!-- End Toggler -->
						</div>
					</div>
	
					<ul class="navbar-nav">
						<!-- Demos -->
						<span class="avatar avatar-xs avatar-circle">
							<img class="avatar-img" src="{{ Storage::disk('s3l')->url('flag/ca.png') }}" alt="Image Description">
						</span>
						<li class="nav-item">
							{{-- <a id="demosMegaMenu" class="hs-mega-menu-invoker nav-link active" aria-current="page" href="#" role="button">Demos</a> --}}
							@auth
								<a href="{{ route('dashboards.index') }}" class="nav-link text-muted">
									<i class="bi bi-speedometer2 nav-icon"></i>
									Dashboard
								</a>
							@endauth
							@guest
								<a href="{{ route('register') }}" class="nav-link text-muted">
									<i class="bi bi-plus-circle text-primary"></i>
									Register
								</a>
							@endguest
						</li>
						<!-- End Demos -->
	
						<!-- Docs -->
						{{-- <li class="nav-item">
						<a id="docsMegaMenu" class="hs-mega-menu-invoker nav-link" href="#" role="button">Docs</a>
					  </li> --}}
	
						@auth
							<li class="nav-item">
								<a href="{{ route('users.show', auth()->user()->id) }}" class="nav-link text-muted">
									{{-- <i class="bi-person-circle  nav-icon"></i> --}}
									<span class="avatar avatar-xs avatar-circle">
										{{-- <img class="avatar-img" src="{{ url($_avatar_dir.$_landlord_user->avatar) }}"  alt="{{ $_landlord_user->name }}" title="{{ $_landlord_user->name }}"> --}}
										<img class="avatar-img" src="{{ Storage::disk('s3la')->url($_landlord_user->avatar)  }}"  alt="{{ $_landlord_user->name }}" title="{{ $_landlord_user->name }}">
									</span>
									{{ Str::limit(auth()->user()->name, 15, '...') }}
								</a>
	
								{{-- <img class="avatar avatar-xs avatar-circle" src="{{ url($_avatar_dir.$_landlord_user->avatar) }}"
									alt="{{ $_landlord_user->name }}" title="{{ $_landlord_user->name }}"> --}}
							</li>
							<li class="nav-item">
								<a href="{{ route('logout') }}" class="nav-link text-muted">
									<i class="bi bi-power nav-icon text-danger"></i>
									Logout
								</a>
							</li>
						@endauth
						@guest
							<li class="nav-item">
								<a href="{{ route('login') }}" class="nav-link text-muted">
									<i class="bi bi-power text-primary"></i>
									Login
								</a>
							</li>
						@endguest
	
						<!-- End Docs -->
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
	
						<!-- Company --> 
						<li class="nav-item">
							<a id="companyMegaMenu" class="hs-mega-menu-invoker nav-link {{ $_route_name == 'product' ? 'active' : '' }}" 
								href="{{ route('product') }}" role="button" aria-expanded="false">Product</a>
						</li>
						<!-- End Company -->
	
						<!-- Account -->
						<li class="nav-item">
							<a id="accountMegaMenu" class="hs-mega-menu-invoker nav-link {{ $_route_name == 'pricing' ? 'active' : '' }}"
								href="{{ route('pricing') }}" role="button" aria-expanded="false">Pricing</a>
						</li>
						<!-- End Account -->
	
						<!-- Pages -->
						<li class="nav-item">
							<a id="faqMegaMenu" class="hs-mega-menu-invoker nav-link {{ $_route_name == 'faq' ? 'active' : '' }}" 
								href="{{ route('faq') }}" role="button" aria-expanded="false">FAQ</a>
						</li>
						<!-- End Pages -->
	
						<!-- Pages -->
						<li class="nav-item">
							<a id="contactMegaMenu" class="hs-mega-menu-invoker nav-link {{ $_route_name == 'contact-us' ? 'active' : '' }}"
								href="{{ route('contact-us') }}" role="button" aria-expanded="false">Contact Us</a>
						</li>
						<!-- End Pages -->
	
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
