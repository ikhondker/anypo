
<!-- TAGLINE START-->
<div class="tagline bg-white">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="d-flex align-items-center justify-content-between">
					<ul class="list-unstyled mb-0">
						<li class="list-inline-item mb-0">
							<a href="{{ route('contact-us') }}" class="text-muted fw-normal"><i data-feather="mail" class="fea icon-sm text-primary"></i>{{ config('bo.SETUP_EMAIL') }}</a>
						</li>
						<li class="list-inline-item mb-0 ms-3">
							<a href="{{ route('contact-us') }}" class="text-muted fw-normal"><i data-feather="map-pin" class="fea icon-sm text-primary"></i> {{ config('bo.SETUP_ADDRESS') }}</a>
						</li>
					</ul>

					<ul class="list-unstyled social-icon tagline-social mb-0">
						<li class="list-inline-item mb-0"><a href="javascript:void(0)"><i class="uil uil-facebook-f h6 mb-0"></i></a></li>
						<li class="list-inline-item mb-0"><a href="javascript:void(0)"><i class="uil uil-instagram h6 mb-0"></i></a></li>
						<li class="list-inline-item mb-0"><a href="javascript:void(0)"><i class="uil uil-twitter h6 mb-0"></i></a></li>
						<li class="list-inline-item mb-0"><a href="javascript:void(0)"><i class="uil uil-linkedin h6 mb-0"></i></a></li>
					</ul><!--end icon-->

					<ul class="list-unstyled mb-0">
						<li class="list-inline-item mb-0">
							@auth
								<a href="{{ route('dashboards.index') }}" class="text-muted fw-normal">
									<i data-feather="pie-chart" class="fea icon-sm text-primary"></i>
									Dashboard
								</a>
							@endauth
							@guest
								<a href="{{ route('register') }}" class="text-muted fw-normal">
									<i data-feather="clipboard" class="fea icon-sm text-primary"></i>
									Register
								</a>
							@endguest
						</li>


							@auth
								<li class="list-inline-item mb-0 ms-3">
								<a href="{{ route('users.show',auth()->user()->id) }}" class="text-muted fw-normal">
									<i data-feather="user" class="fea icon-sm text-primary"></i>
									{{ Str::limit(auth()->user()->email, 15, '...') }}
								</a>
								</li>
								<li class="list-inline-item mb-0 ms-3">
								<a href="{{ route('logout') }}" class="text-muted fw-normal">
									<i data-feather="log-out" class="fea icon-sm text-primary"></i>
									Logout
								</a>
								</li>
							@endauth
							@guest
								<li class="list-inline-item mb-0 ms-3">
								<a href="{{ route('login') }}" class="text-muted fw-normal">
									<i data-feather="log-in" class="fea icon-sm text-primary"></i>
									Login
								</a>
								</li>
							@endguest

					</ul>
				</div>
			</div><!--end col-->
		</div><!--end row-->
	</div><!--end container-->
</div><!--end tagline-->
<!-- TAGLINE END-->