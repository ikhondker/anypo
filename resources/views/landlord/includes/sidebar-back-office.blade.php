<li class="sidebar-item {{ ($_route_name == 'home' ? 'active' : '') }}">
	<a class="sidebar-link" href="{{ route('home') }}">
		<i class="align-middle" data-lucide="home"></i><span class="align-middle">Home</span>
	</a>
</li>

<li class="sidebar-item {{ $_route_name == 'dashboards.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('dashboards.index') }}">
		<i class="align-middle" data-lucide="chart-pie"></i> <span class="align-middle">Dashboards</span>
	</a>
</li>

<li class="sidebar-item {{ $_route_name == 'tickets.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('tickets.index') }}">
		<i class="align-middle" data-lucide="list-todo"></i> <span class="align-middle">All Tickets</span>
	</a>
</li>

<li class="sidebar-item {{ $_route_name == 'comments.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('comments.all') }}">
		<i class="align-middle" data-lucide="list-todo"></i> <span class="align-middle">All Comments</span>
	</a>
</li>

@can('viewWorkbenchMenu', App\Models\Landlord\Manage\Menu::class)
	<li class="sidebar-item {{ ($_node_name == 'workbench' ? 'active' : '') }}">
		<a data-bs-target="#workbench"s data-bs-toggle="collapse" class="sidebar-link collapsed">
			<i class="align-middle" data-lucide="layout-grid"></i>
			<span class="align-middle">Workbench</span>
		</a>
		<ul id="workbench" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'workbench' ? 'show' : '') }}" data-bs-parent="#sidebar">
			{{-- <li class="sidebar-item {{ ($_route_name == 'tickets.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('tickets.all') }}"><i class="align-middle" data-lucide="circle"></i>All Tickets</a></li> --}}
			<li class="sidebar-item {{ ($_route_name == 'checkouts.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('checkouts.index') }}"><i class="align-middle" data-lucide="circle"></i>All Checkouts</a></li>
			<li class="sidebar-item {{ ($_route_name == 'accounts.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('accounts.index') }}"><i class="align-middle" data-lucide="circle"></i>All Accounts</a></li>
			<li class="sidebar-item {{ ($_route_name == 'services.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('services.all') }}"><i class="align-middle" data-lucide="circle"></i>All Services</a></li>
			<li class="sidebar-item {{ ($_route_name == 'invoices.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('invoices.all') }}"><i class="align-middle" data-lucide="circle"></i>All Invoices</a></li>
			<li class="sidebar-item {{ ($_route_name == 'payments.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('payments.all') }}"><i class="align-middle" data-lucide="circle"></i>All Payments</a></li>
			<li class="sidebar-item {{ ($_route_name == 'users.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.all') }}"><i class="align-middle" data-lucide="circle"></i>All Users</a></li>
			<li class="sidebar-item {{ ($_route_name == 'tenants.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('tenants.index') }}"><i class="align-middle" data-lucide="circle"></i>All Tenants</a></li>
			<li class="sidebar-item {{ ($_route_name == 'domains.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('domains.index') }}"><i class="align-middle" data-lucide="circle"></i>All Domains</a></li>
			<li class="sidebar-item {{ ($_route_name == 'contacts.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('contacts.all') }}"><i class="align-middle" data-lucide="circle"></i>All Contacts</a></li>
		</ul>
	</li>
@endcan



@can('viewLookupMenu', App\Models\Landlord\Manage\Menu::class)
	<li class="sidebar-item {{ ($_node_name == 'lookups' ? 'active' : '') }}">
		<a data-bs-target="#lookups" data-bs-toggle="collapse" class="sidebar-link collapsed">
			<i class="align-middle" data-lucide="layout-grid"></i>
			<span class="align-middle">Lookups</span>
		</a>
		<ul id="lookups" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'lookups' ? 'show' : '') }}" data-bs-parent="#sidebar">
			<li class="sidebar-item {{ ($_route_name == 'products.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('products.index') }}"><i class="align-middle" data-lucide="circle"></i>Product</a></li>
			<li class="sidebar-item {{ ($_route_name == 'categories.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('categories.index') }}"><i class="align-middle" data-lucide="circle"></i>Category</a></li>
			<li class="sidebar-item {{ ($_route_name == 'countries.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('countries.index') }}"><i class="align-middle" data-lucide="circle"></i>Country</a></li>
			<li class="sidebar-item {{ ($_route_name == 'topics.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('topics.index') }}"><i class="align-middle" data-lucide="circle"></i>Topic</a></li>
		</ul>
	</li>
@endcan

@can('viewSystemMenu', App\Models\Landlord\Manage\Menu::class)
	<li class="sidebar-item {{ ($_node_name == 'system' ? 'active' : '') }}">
		<a data-bs-target="#system" data-bs-toggle="collapse" class="sidebar-link collapsed">
			<i class="align-middle" data-lucide="layout-grid"></i>
			<span class="align-middle">System</span>
		</a>
		<ul id="system" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'sysadmin' ? 'show' : '') }}" data-bs-parent="#sidebar">
			<li class="sidebar-item {{ ($_route_name == 'mail-lists.all' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('mail-lists.index') }}"><i class="align-middle" data-lucide="circle"></i>Mail Lists</a></li>
			<li class="sidebar-item {{ ($_route_name == 'error-logs.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('error-logs.index') }}"><i class="align-middle" data-lucide="circle"></i>Error logs</a></li>
			<li class="sidebar-item {{ ($_route_name == 'activities.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('activities.all') }}"><i class="align-middle" data-lucide="circle"></i>Activity Log</a></li>
			<li class="sidebar-item {{ ($_route_name == 'attachments.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('attachments.all') }}"><i class="align-middle" data-lucide="circle"></i>Attachments*</a></li>
		</ul>
	</li>
@endcan

@can('viewSysMenu', App\Models\Landlord\Manage\Menu::class)
	<li class="sidebar-item {{ ($_node_name == 'sys' ? 'active' : '') }}">
		<a data-bs-target="#sys" data-bs-toggle="collapse" class="sidebar-link collapsed">
			<i class="align-middle" data-lucide="layout-grid"></i>
			<span class="align-middle">Sys</span>
		</a>
		<ul id="sys" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'sys' ? 'show' : '') }}" data-bs-parent="#sidebar">
			<li class="sidebar-item {{ ($_route_name == 'tables.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('tables.index') }}"><i class="align-middle" data-lucide="circle"></i>Tables</a></li>
			<li class="sidebar-item {{ ($_route_name == 'cps.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('cps.index') }}"><i class="align-middle" data-lucide="circle"></i>Control Panel</a></li>
			<li class="sidebar-item {{ ($_route_name == 'processes.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('processes.index') }}"><i class="align-middle" data-lucide="circle"></i>Processes</a></li>
			<li class="sidebar-item {{ ($_route_name == 'menus.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('menus.index') }}"><i class="align-middle" data-lucide="circle"></i>Menu</a></li>
			<li class="sidebar-item {{ ($_route_name == 'statuses.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('statuses.index') }}"><i class="align-middle" data-lucide="circle"></i>Status</a></li>
			<li class="sidebar-item {{ ($_route_name == 'entities.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('entities.index') }}"><i class="align-middle" data-lucide="circle"></i>Entity</a></li>
			<li class="sidebar-item {{ ($_route_name == 'reply-templates.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('reply-templates.index') }}"><i class="align-middle" data-lucide="circle"></i>Reply Templates</a></li>
			<li class="sidebar-item {{ ($_route_name == 'templates.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('templates.index') }}"><i class="align-middle" data-lucide="circle"></i>Templates</a></li>
			<li class="sidebar-item {{ ($_route_name == 'configs.show' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('configs.show',config('bo.CONFIG_ID')) }}"><i class="align-middle" data-lucide="circle"></i>Config</a></li>

		</ul>
	</li>
@endcan

<!-- ========== Profile ========== -->
@include('landlord.includes.sidebar-my-profile')
<!-- ========== End Profile ========== -->

