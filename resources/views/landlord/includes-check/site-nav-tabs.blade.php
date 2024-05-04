{{-- https://blog.quickadminpanel.com/laravel-how-to-make-menu-item-active-by-urlroute/ --}}

<!-- Hero Start -->
<section class="bg-half-170 bg-light pb-0 d-table w-100" style="background: url('{{asset('/site/images/bg/corporate01.png')}}') center center;">
	<div class="container">
		<div class="row mt-5 align-items-center">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link {{ (request()->segment(1) == 'dashboards') ? 'text-primary active' : 'text-muted' }}" href="{{ route('dashboards.index') }}">Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ (request()->segment(1) == 'tickets') ? 'text-primary active' : 'text-muted' }}" href="{{ route('tickets.index') }}">Tickets</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ (request()->segment(1) == 'accounts') ? 'text-primary active' : 'text-muted' }}" href="{{ route('accounts.index') }}">Account</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ (request()->segment(1) == 'services') ? 'text-primary active' : 'text-muted' }}" href="{{ route('services.index') }}">Services</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ (request()->segment(1) == 'invoices') ? 'text-primary active' : 'text-muted' }}" href="{{ route('invoices.index') }}">Invoices</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ (request()->segment(1) == 'payments') ? 'text-primary active' : 'text-muted' }}" href="{{ route('payments.index') }}">Payments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ (request()->segment(1) == 'users') ? 'text-primary active' : 'text-muted' }}" href="{{ route('users.index') }}">Users</a>
				</li>
			</ul>
		</div><!--end row-->
	</div> <!--end container-->
</section><!--end section-->
<!-- Hero End -->

{{-- <!-- Start -->
<section class="section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="filters-group-wrap text-center">
					<div class="filters-group">
						<ul class="container-filter mb-0 categories-filter list-unstyled filter-options">
							<li class="list-inline-item categories position-relative active">
								<a href="{{ route('dashboards.index') }}" class="text-muted fw-normal">
									Dashboard
								</a>
							</li>
							<li class="list-inline-item categories position-relative">
								<a href="{{ route('dashboards.index') }}" class="text-muted fw-normal">
									Notification
								</a>
							</li>
							<li class="list-inline-item categories position-relative">
								<a href="{{ route('tickets.index') }}" class="text-muted fw-normal">
								Tickets
								</a>
							</li>
							<li class="list-inline-item categories position-relative">
								<a href="{{ route('accounts.index') }}" class="text-muted fw-normal">
								Accounts
								</a>
							</li>
							<li class="list-inline-item categories position-relative">
								<a href="{{ route('services.index') }}" class="text-muted fw-normal">
								Services
								</a>
							</li>
							<li class="list-inline-item categories position-relative">
								<a href="{{ route('invoices.index') }}" class="text-muted fw-normal">
								Invoices
								</a>
							</li>
							<li class="list-inline-item categories position-relative">
								<a href="{{ route('payments.index') }}" class="text-muted fw-normal">
								Payments
								</a>
							</li>
							<li class="list-inline-item categories position-relative">
								<a href="{{ route('users.index') }}" class="text-muted fw-normal">
								Users
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div><!--end col-->
		</div><!--end row-->
	</div><!--end container-->
</section><!--end section-->
<!-- End --> --}}


