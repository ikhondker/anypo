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
		<a class="nav-link {{ $_route_name == 'tickets.index' ? 'active' : '' }}" href="{{ route('tickets.all') }}">
			<i class="bi-ticket nav-icon"></i>All Tickets
		</a>
	</li>

	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'checkouts.index' ? 'active' : '' }}" href="{{ route('checkouts.all') }}">
			<i class="bi-cart-plus nav-icon"></i>
			All Checkouts</a>
	</li>

	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'accounts.index' ? 'active' : '' }}" href="{{ route('accounts.all') }}">
			<i class="bi-ui-checks-grid nav-icon"></i> All Accounts</a>
	</li>

	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'services.index' ? 'active' : '' }}" href="{{ route('services.all') }}">
			<i class="bi-columns nav-icon"></i> All Services</a>
	</li>

	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'invoices.index' ? 'active' : '' }}" href="{{ route('invoices.all') }}">
			<i class="bi-file-ruled nav-icon"></i> All Invoices
		</a>
	</li>

	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'payments.index' ? 'active' : '' }}" href="{{ route('payments.all') }}">
			<i class="bi-currency-dollar nav-icon"></i> All Payments
		</a>
	</li>

	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'contacts.index' ? 'active' : '' }}" href="{{ route('contacts.all') }}">
			<i class="bi-person-lines-fill nav-icon"></i> All Contacts</a>
	</li>
</ul>
<!-- End List -->

<!-- Nav -->
<span class="text-cap">ADMIN</span>
<!-- List -->
<ul class="nav nav-sm nav-tabs nav-vertical mb-4">
	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'users.index' ? 'active' : '' }}" href="{{ route('users.all') }}">
			<i class="bi-people nav-icon"></i> All Users</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'activities.index' ? 'active' : '' }}"
			href="{{ route('activities.all') }}">
			<i class="bi-activity nav-icon"></i> All Activity</a>
	</li>
	<li class="nav-item">
		<a class="nav-link {{ $_route_name == 'attachments.index' ? 'active' : '' }}"
			href="{{ route('attachments.index') }}">
			<i class="bi-paperclip nav-icon"></i>
			All Attachments</a>
	</li>
	<li class="nav-item"><a class="nav-link {{ $_route_name == 'processes.index' ? 'active' : '' }}"
			href="{{ route('processes.index') }}">
			<i class="bi-cpu nav-icon"></i>
			Run Process</a>
	</li>
</ul>
<!-- End List -->



@if (auth()->user()->role->value == \UserRoleEnum::SYSTEM->value)
	<!-- Nav -->
	<span class="text-cap">SYSTEM</span>

	<!-- List -->
	<ul class="nav nav-sm nav-tabs nav-vertical mb-4">
		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'tables.index' ? 'active' : '' }}"
				href="{{ route('tables.index') }}"><i class="bi-bell nav-icon"></i> Tables</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'templates.index' ? 'active' : '' }}"
				href="{{ route('templates.index') }}"><i class="bi-bell nav-icon"></i> Templates</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'products.index' ? 'active' : '' }}"
				href="{{ route('products.index') }}">
				<i class="bi-bell nav-icon"></i> Products </a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'categories.index' ? 'active' : '' }}"
				href="{{ route('categories.index') }}">
				<i class="bi-bell nav-icon"></i> Category </a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'countries.index' ? 'active' : '' }}"
				href="{{ route('countries.index') }}">
				<i class="bi-bell nav-icon"></i> Country</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'tenants.index' ? 'active' : '' }}"
				href="{{ route('tenants.index') }}">
				<i class="bi-bell nav-icon"></i> Tenant</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'domains.index' ? 'active' : '' }}"
				href="{{ route('domains.index') }}"><i class="bi-bell nav-icon"></i> Domain</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'entities.index' ? 'active' : '' }}"
				href="{{ route('entities.index') }}"><i class="bi-bell nav-icon"></i> Entity</a>
		</li>
		
		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'mail-lists.index' ? 'active' : '' }}"
				href="{{ route('mail-lists.index') }}"><i class="bi-bell nav-icon"></i> Mail List</a>
		</li>

		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'statuses.index' ? 'active' : '' }}"
				href="{{ route('statuses.index') }}"><i class="bi-bell nav-icon"></i> Status</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'menus.index' ? 'active' : '' }}"
				href="{{ route('menus.index') }}"><i class="bi-bell nav-icon"></i> Menu</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ $_route_name == 'setups.index' ? 'active' : '' }}"
				href="{{ route('setups.index') }}"><i class="bi-bell nav-icon"></i> Setup</a>
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
