<li class="sidebar-header">
	Navigation
</li>

<li class="sidebar-item {{ $_route_name == 'dashboards.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('dashboards.index') }}">
		<i class="align-middle" data-lucide="sliders"></i> <span class="align-middle">Dashboards</span>
	</a>
</li>


<li class="sidebar-item {{ $_route_name == 'tickets.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('tickets.all') }}">
		<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">All Tickets</span>
	</a>
</li>

<li class="sidebar-item {{ $_route_name == 'checkouts.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('checkouts.index') }}">
		<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">All Checkouts</span>
	</a>
</li>

<li class="sidebar-item {{ $_route_name == 'accounts.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('accounts.all') }}">
		<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">All Accounts</span>
	</a>
</li>

<li class="sidebar-item {{ $_route_name == 'services.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('services.all') }}">
		<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">All Services</span>
	</a>
</li>
<li class="sidebar-item {{ $_route_name == 'invoices.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('invoices.all') }}">
		<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">All Invoices</span>
	</a>
</li>
<li class="sidebar-item {{ $_route_name == 'payments.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('payments.all') }}">
		<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">All Payments</span>
	</a>
</li>
<li class="sidebar-item {{ $_route_name == 'contacts.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('contacts.all') }}">
		<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">All Contacts</span>
	</a>
</li>


<li class="sidebar-header">
	ADMIN
</li>
<li class="sidebar-item {{ $_route_name == 'users.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('users.all') }}">
		<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">All Users</span>
	</a>
</li>
<li class="sidebar-item {{ $_route_name == 'activities.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('activities.all') }}">
		<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">All Activity</span>
	</a>
</li>
<li class="sidebar-item {{ $_route_name == 'attachments.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('attachments.index') }}">
		<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">All Attachments</span>
	</a>
</li>





@if (auth()->user()->role->value == \UserRoleEnum::SYSTEM->value)
	<!-- Nav -->
	<li class="sidebar-header">
		SYSTEM
	</li>
	<li class="sidebar-item {{ $_route_name == 'tables.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('tables.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Tables</span>
		</a>
	</li>
	<li class="sidebar-item {{ $_route_name == 'error-logs.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('error-logs.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Error logs</span>
		</a>
	</li>
	<li class="sidebar-item {{ $_route_name == 'templates.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('templates.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Templates</span>
		</a>
	</li>
	<li class="sidebar-item {{ $_route_name == 'products.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('products.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Products</span>
		</a>
	</li>

	<li class="sidebar-item {{ $_route_name == 'categories.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('categories.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Categories</span>
		</a>
	</li>
	<li class="sidebar-item {{ $_route_name == 'countries.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('countries.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Countries</span>
		</a>
	</li>

	<li class="sidebar-item {{ $_route_name == 'processes.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('processes.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Processes</span>
		</a>
	</li>

	<li class="sidebar-item {{ $_route_name == 'tenants.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('tenants.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Tenants</span>
		</a>
	</li>
	<li class="sidebar-item {{ $_route_name == 'domains.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('domains.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Domains</span>
		</a>
	</li>
	<li class="sidebar-item {{ $_route_name == 'entities.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('entities.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Entities</span>
		</a>
	</li>


	<li class="sidebar-item {{ $_route_name == 'mail-lists.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('mail-lists.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Mail lists</span>
		</a>
	</li>
	<li class="sidebar-item {{ $_route_name == 'statuses.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('statuses.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Statuses</span>
		</a>
	</li>
	<li class="sidebar-item {{ $_route_name == 'menus.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('menus.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Menus</span>
		</a>
	</li>
	<li class="sidebar-item {{ $_route_name == 'ui' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('ui') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">UI</span>
		</a>
	</li>
	<li class="sidebar-item {{ $_route_name == 'cps.changelog' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('cps.changelog') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Change Log</span>
		</a>
	</li>

	<li class="sidebar-item {{ $_route_name == 'cps.codegen' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('cps.codegen') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Code Gen (All Tenant)</span>
		</a>
	</li>
	
	<li class="sidebar-item {{ $_route_name == 'configs.index' ? 'active' : '' }}">
		<a class="sidebar-link" href="{{ route('configs.index') }}">
			<i class="align-middle" data-lucide="circle"></i> <span class="align-middle">Config</span>
		</a>
	</li>
@endif

<!-- ========== Account ========== -->
@include('landlord.includes.sidebar-my-account')
<!-- ========== END Account ========== -->

