<ul class="sidebar-nav">

	<li class="sidebar-item {{ ($_route_name == 'home' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('home') }}">
			<i class="align-middle" data-lucide="home"></i><span class="align-middle">Home</span>
		</a>
	</li>

	<li class="sidebar-item {{ ($_route_name == 'notifications.index' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('notifications.index') }}">
			<i class="align-middle" data-lucide="message-square"></i><span class="align-middle">Notifications*</span>
			<span class="badge badge-sidebar-primary">{{ $_count_unread_notifications }}</span>
		</a>
	</li>

	@if (auth()->user()->role->value == UserRoleEnum::USER->value)
		<li class="sidebar-item {{ ($_route_name == 'prs.index' ? 'active' : '') }}">
			<a class="sidebar-link" href="{{ route('prs.index') }}">
				<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Requisitions*</span>
			</a>
		</li>
	@endif

	@can('viewWorkbenchMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'workbench' ? 'active' : '') }}">
			<a data-bs-target="#workbench"s data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-lucide="layout-template"></i>
				<span class="align-middle">Workbench *</span>
			</a>
			<ul id="workbench" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'workbench' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'prs.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('prs.index') }}"><i class="align-middle" data-lucide="circle"></i>Requisitions*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'pos.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('pos.index') }}"><i class="align-middle" data-lucide="circle"></i>Purchase Orders*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'receipts.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('receipts.index') }}"><i class="align-middle" data-lucide="circle"></i>Receipts*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'invoices.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('invoices.index') }}"><i class="align-middle" data-lucide="circle"></i>Invoices*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'payments.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('payments.index') }}"><i class="align-middle" data-lucide="circle"></i>Payments*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'aehs.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('aehs.index') }}"><i class="align-middle" data-lucide="circle"></i>Accounting*</a></li>
			</ul>
		</li>
	@endcan

	@can('viewBudgetMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'budget' ? 'active' : '') }}">
			<a data-bs-target="#budget" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-lucide="layout-template"></i>
				<span class="align-middle">Budget</span>
			</a>
			<ul id="budget" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'budget' ? 'show' : '') }}" data-bs-parent="#sidebar">
				@can('viewAny', App\Models\Tenant\Budget::class)
					<li class="sidebar-item {{ ($_route_name == 'budgets.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('budgets.index') }}"><i class="align-middle" data-lucide="circle"></i>Budget*</a></li>
				@endcan
				@can('viewAny', App\Models\Tenant\DeptBudget::class)
					<li class="sidebar-item {{ ($_route_name == 'dept-budgets.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('dept-budgets.index') }}"><i class="align-middle" data-lucide="circle"></i>Dept Budgets*</a></li>
				@endcan
				@can('spends', App\Models\Tenant\Lookup\Supplier::class)
					<li class="sidebar-item {{ ($_route_name == 'suppliers.spends' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('suppliers.spends') }}"><i class="align-middle" data-lucide="circle"></i>Supplier Spends*</a></li>
				@endcan
				@can('spends', App\Models\Tenant\Lookup\Project::class)
					<li class="sidebar-item {{ ($_route_name == 'projects.spends' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('projects.spends') }}"><i class="align-middle" data-lucide="circle"></i>Project Spends*</a></li>
					@endcan
				@can('viewAny', App\Models\Tenant\Dbu::class)
					<li class="sidebar-item {{ ($_route_name == 'dbus.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('dbus.index') }}"><i class="align-middle" data-lucide="circle"></i>Budget Usage*</a></li>
				@endcan
			</ul>
		</li>
	@endcan

	@can('viewReportMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_route_name == 'reports.index' ? 'active' : '') }}">
			<a class="sidebar-link" href="{{ route('reports.index') }}">
				<i class="align-middle" data-lucide="layout"></i><span class="align-middle">Reports</span>
			</a>
		</li>
	@endcan

	@can('viewMasterDataMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'master' ? 'active' : '') }}">
			<a data-bs-target="#master" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-lucide="layout-template"></i>
				<span class="align-middle">Master Data</span>
			</a>
			<ul id="master" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'master' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'items.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('items.index') }}"><i class="align-middle" data-lucide="circle"></i>Items</a></li>
				<li class="sidebar-item {{ ($_route_name == 'suppliers.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('suppliers.index') }}"><i class="align-middle" data-lucide="circle"></i>Suppliers</a></li>
				<li class="sidebar-item {{ ($_route_name == 'projects.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('projects.index') }}"><i class="align-middle" data-lucide="circle"></i>Projects*</a></li>
			</ul>
		</li>
	@endcan

	@can('viewLookupMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'lookups' ? 'active' : '') }}">
			<a data-bs-target="#lookups" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-lucide="layout-template"></i>
				<span class="align-middle">Lookups</span>
			</a>
			<ul id="lookups" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'lookups' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'depts.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('depts.index') }}"><i class="align-middle" data-lucide="circle"></i>Dept</a></li>
				<li class="sidebar-item {{ ($_route_name == 'categories.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('categories.index') }}"><i class="align-middle" data-lucide="circle"></i>Category</a></li>
				<li class="sidebar-item {{ ($_route_name == 'uoms.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('uoms.index') }}"><i class="align-middle" data-lucide="circle"></i>UOM</a></li>
				<li class="sidebar-item {{ ($_route_name == 'designations.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('designations.index') }}"><i class="align-middle" data-lucide="circle"></i>Designation</a></li>
				<li class="sidebar-item {{ ($_route_name == 'oems.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('oems.index') }}"><i class="align-middle" data-lucide="circle"></i>OEM</a></li>
				<li class="sidebar-item {{ ($_route_name == 'warehouses.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('warehouses.index') }}"><i class="align-middle" data-lucide="circle"></i>Warehouse</a></li>
				<li class="sidebar-item {{ ($_route_name == 'bank-accounts.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('bank-accounts.index') }}"><i class="align-middle" data-lucide="circle"></i>Bank Accounts</a></li>
				<li class="sidebar-item {{ ($_route_name == 'currencies.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('currencies.index') }}"><i class="align-middle" data-lucide="circle"></i>Currency</a></li>
			</ul>
		</li>
	@endcan

	@can('viewInterfaceMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'interface' ? 'active' : '') }}">
			<a data-bs-target="#interface" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-lucide="layout-template"></i>
				<span class="align-middle">Interface</span>
			</a>
			<ul id="interface" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'interface' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'upload-items.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('upload-items.index') }}"><i class="align-middle" data-lucide="circle"></i>Item Interface</a></li>
				<li class="sidebar-item {{ ($_route_name == 'upload-items.create' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('upload-items.create') }}"><i class="align-middle" data-lucide="circle"></i>Item Upload</a></li>
			</ul>
		</li>
	@endcan

	@can('viewAdminMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'admin' ? 'active' : '') }}">
			<a data-bs-target="#admin" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-lucide="layout-template"></i>
				<span class="align-middle">Admin</span>
			</a>
			<ul id="admin" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'admin' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'users.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.index') }}"><i class="align-middle" data-lucide="circle"></i>Users</a></li>
				<li class="sidebar-item {{ ($_route_name == 'hierarchies.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('hierarchies.index') }}"><i class="align-middle" data-lucide="circle"></i>Hierarchy</a></li>
				<li class="sidebar-item {{ ($_route_name == 'activities.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('activities.index') }}"><i class="align-middle" data-lucide="circle"></i>Activity Log</a></li>
				<li class="sidebar-item {{ ($_route_name == 'attachments.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('attachments.index') }}"><i class="align-middle" data-lucide="circle"></i>Attachments*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'wfs.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('wfs.index') }}"><i class="align-middle" data-lucide="circle"></i>Workflow</a></li>
				<li class="sidebar-item {{ ($_route_name == 'rates.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('rates.index') }}"><i class="align-middle" data-lucide="circle"></i>Exchange Rate</a></li>
				<li class="sidebar-item {{ ($_route_name == 'setups.show' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('setups.show',1001) }}"><i class="align-middle" data-lucide="circle"></i>Setup</a></li>
			</ul>
		</li>
	@endcan

	@can('viewSystemMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'system' ? 'active' : '') }}">
			<a data-bs-target="#system" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-lucide="layout-template"></i>
				<span class="align-middle">System</span>
			</a>
			<ul id="system" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'system' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'tables.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('tables.index') }}"><i class="align-middle" data-lucide="circle"></i>Tables</a></li>
				<li class="sidebar-item {{ ($_route_name == 'menus.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('menus.index') }}"><i class="align-middle" data-lucide="circle"></i>Menu</a></li>
				<li class="sidebar-item {{ ($_route_name == 'statuses.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('statuses.index') }}"><i class="align-middle" data-lucide="circle"></i>Status</a></li>
				<li class="sidebar-item {{ ($_route_name == 'entities.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('entities.index') }}"><i class="align-middle" data-lucide="circle"></i>Entity</a></li>
				<li class="sidebar-item {{ ($_route_name == 'prls.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('prls.index') }}"><i class="align-middle" data-lucide="circle"></i>Prl*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'aehs.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('aehs.index') }}"><i class="align-middle" data-lucide="circle"></i>Aeh*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'custom-errors.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('custom-errors.index') }}"><i class="align-middle" data-lucide="circle"></i>Custom Errors</a></li>
				<li class="sidebar-item {{ ($_route_name == 'groups.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('groups.index') }}"><i class="align-middle" data-lucide="circle"></i>Item Groups</a></li>
				<li class="sidebar-item {{ ($_route_name == 'countries.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('countries.index') }}"><i class="align-middle" data-lucide="circle"></i>Country</a></li>
				<li class="sidebar-item {{ ($_route_name == 'templates.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('templates.index') }}"><i class="align-middle" data-lucide="circle"></i>Templates</a></li>
				<li class="sidebar-item {{ ($_route_name == 'ui' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('ui') }}"><i class="align-middle" data-lucide="circle"></i>UI</a></li>

			</ul>
		</li>
	@endcan

	@include('tenant.includes.sidebar-my-account')

</ul>
