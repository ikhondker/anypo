<!-- Nav -->
<span class="text-cap">Menu</span>

<!-- List -->
<ul class="nav nav-sm nav-tabs nav-vertical mb-4">
	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'dashboards.index' ? 'active' : '' }}" href="{{ route('dashboards.index') }}">
			<i class="bi bi-house-door nav-icon"></i> Home
		</a>
	</li>
	{{-- <li class="nav-item">
		<a class="nav-link " href="./account-notifications.html">
			<i class="bi-bell nav-icon"></i> Notifications
			<span class="badge bg-soft-dark text-dark rounded-pill nav-link-badge">1</span>
		</a>
	</li> --}}
	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'tickets.create' ? 'active' : '' }}" href="{{ route('tickets.create') }}">
			<i class="bi bi-ticket nav-icon"></i> Create Ticket
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'tickets.index' ? 'active' : '' }}" href="{{ route('tickets.index') }}">
			<i class="bi bi-list-task nav-icon"></i> All Tickets
		</a>
	</li>

</ul>
<!-- End List -->

@if (auth()->user()->role->value == \UserRoleEnum::ADMIN->value)
	<!-- Nav -->
	<span class="text-cap">ADMIN</span>
	<!-- List -->
	<ul class="nav nav-sm nav-tabs nav-vertical mb-4">
		
		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'accounts.show' ? 'active' : '' }}" href="{{ route('accounts.show',auth()->user()->account_id) }}">
				<i class="bi-ui-checks-grid nav-icon"></i> Accounts
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'invoices.index' ? 'active' : '' }}"
				href="{{ route('invoices.index') }}">
				<i class="bi-file-ruled nav-icon"></i> Invoices
			</a>
		</li>


		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'payments.index' ? 'active' : '' }}"
				href="{{ route('payments.index') }}">
				<i class="bi-currency-dollar nav-icon"></i> Payments
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'users.index' ? 'active' : '' }}" href="{{ route('users.index') }}">
				<i class="bi-people nav-icon"></i> Users
			</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'invoices.index' ? 'active' : '' }}"
				href="{{ route('invoices.generate') }}">
				<i class="bi-file-ruled nav-icon"></i> Generate Invoice
			</a>
		</li>
		
		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'services.index' ? 'active' : '' }}" href="{{ route('services.index') }}">
				<i class="bi-people nav-icon"></i> Buy Users
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link " href="{{ route('activities.index') }}">
				<i class="bi-activity nav-icon"></i> Activity Log</a>
		</li>

	</ul>
	<!-- End List -->
@endif

<!-- ========== Account ========== -->
@include('landlord.includes.submenu-account')
<!-- ========== END Account ========== -->

<div class="d-lg-none">
	<div class="dropdown-divider"></div>
	<!-- List -->
	<ul class="nav nav-sm nav-tabs nav-vertical">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('logout') }}">
				<i class="bi-box-arrow-right nav-icon"></i> Log out
			</a>
		</li>
	</ul>
	<!-- End List -->
</div>
<!-- End Nav -->
