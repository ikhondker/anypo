<ul class="sidebar-nav">

	<li class="sidebar-item {{ ($_route_name == 'home' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('home') }}">
			<i class="align-middle" data-feather="home"></i><span class="align-middle">Home</span>
		</a>
	</li>
	
	<li class="sidebar-item {{ ($_route_name == 'notifications.index' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('notifications.index') }}">
			<i class="align-middle" data-feather="bell-off"></i><span class="align-middle">Notifications*</span>
			<span class="badge badge-sidebar-primary">{{ $_count_unread_notifications }}</span>
		</a>
	</li>

	@if (auth()->user()->role->value == UserRoleEnum::USER->value)
		<li class="sidebar-item {{ ($_route_name == 'prs.index' ? 'active' : '') }}">
			<a class="sidebar-link" href="{{ route('prs.index') }}">
				<i class="align-middle" data-feather="layout"></i><span class="align-middle">Requisitions*</span>
			</a>
		</li>
	@endif

	@can('viewPurchaseMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'purchase' ? 'active' : '') }}">
			<a data-bs-target="#purchase"s data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-feather="grid"></i> 
				<span class="align-middle">Purchasing</span>
			</a>
			<ul id="purchase" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'purchase' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'prs.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('prs.index') }}"><i class="align-middle" data-feather="layout"></i>Requisitions*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'pos.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('pos.index') }}"><i class="align-middle" data-feather="layout"></i>Purchase Orders*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'receipts.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('receipts.index') }}"><i class="align-middle" data-feather="layout"></i>Receipts*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'invoices.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('invoices.index') }}"><i class="align-middle" data-feather="layout"></i>Invoices*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'payments.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('payments.index') }}"><i class="align-middle" data-feather="layout"></i>Payments*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'payments.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('payments.index') }}"><i class="align-middle" data-feather="layout"></i>Accounting*</a></li>
			</ul>
		</li>
	@endcan

	@can('viewBudgetMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'budget' ? 'active' : '') }}">
			<a data-bs-target="#budget" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-feather="grid"></i> 
				<span class="align-middle">Budget</span>
			</a>
			<ul id="budget" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'budget' ? 'show' : '') }}" data-bs-parent="#sidebar">
				@can('viewAny', App\Models\Tenant\Budget::class)
					<li class="sidebar-item {{ ($_route_name == 'budgets.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('budgets.index') }}"><i class="align-middle" data-feather="layout"></i>Budget*</a></li>
				@endcan
				<li class="sidebar-item {{ ($_route_name == 'dept-budgets.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('dept-budgets.index') }}"><i class="align-middle" data-feather="layout"></i>Dept Budgets*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'projects.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('projects.index') }}"><i class="align-middle" data-feather="layout"></i>Project Spends*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'suppliers.spends' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('suppliers.spends') }}"><i class="align-middle" data-feather="layout"></i>Supplier Spends*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'dbus.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('dbus.index') }}"><i class="align-middle" data-feather="layout"></i>Budget Usage*</a></li>
			</ul>
		</li>
	@endcan

	@can('viewReportMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_route_name == 'reports.index' ? 'active' : '') }}">
			<a class="sidebar-link" href="{{ route('reports.index') }}">
				<i class="align-middle" data-feather="grid"></i><span class="align-middle">Reports</span>
			</a>
		</li>
	@endcan

	@can('viewMasterDataMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'master' ? 'active' : '') }}">
			<a data-bs-target="#master" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-feather="grid"></i> 
				<span class="align-middle">Master Data</span>
			</a>
			<ul id="master" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'master' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'items.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('items.index') }}"><i class="align-middle" data-feather="circle"></i>Items</a></li>
				<li class="sidebar-item {{ ($_route_name == 'suppliers.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('suppliers.index') }}"><i class="align-middle" data-feather="circle"></i>Supplier</a></li>
			</ul>
		</li>
	@endcan

	@can('viewLookupMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'lookups' ? 'active' : '') }}">
			<a data-bs-target="#lookups" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-feather="grid"></i> 
				<span class="align-middle">Lookups</span>
			</a>
			<ul id="lookups" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'lookups' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'categories.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('categories.index') }}"><i class="align-middle" data-feather="circle"></i>Category</a></li>
				<li class="sidebar-item {{ ($_route_name == 'uoms.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('uoms.index') }}"><i class="align-middle" data-feather="circle"></i>UOM</a></li>
				<li class="sidebar-item {{ ($_route_name == 'depts.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('depts.index') }}"><i class="align-middle" data-feather="circle"></i>Dept</a></li>
				<li class="sidebar-item {{ ($_route_name == 'designations.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('designations.index') }}"><i class="align-middle" data-feather="circle"></i>Designation</a></li>
				<li class="sidebar-item {{ ($_route_name == 'oems.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('oems.index') }}"><i class="align-middle" data-feather="circle"></i>OEM</a></li>
				<li class="sidebar-item {{ ($_route_name == 'warehouses.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('warehouses.index') }}"><i class="align-middle" data-feather="circle"></i>Warehouse</a></li>
				<li class="sidebar-item {{ ($_route_name == 'bank-accounts.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('bank-accounts.index') }}"><i class="align-middle" data-feather="circle"></i>Bank Accounts</a></li>
				<li class="sidebar-item {{ ($_route_name == 'currencies.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('currencies.index') }}"><i class="align-middle" data-feather="circle"></i>Currency</a></li>
				<li class="sidebar-item {{ ($_route_name == 'rates.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('rates.index') }}"><i class="align-middle" data-feather="circle"></i>Exchange Rate</a></li>
				
			</ul>
		</li>
	@endcan

	@can('viewInterfaceMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'interface' ? 'active' : '') }}">
			<a data-bs-target="#interface" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-feather="grid"></i> 
				<span class="align-middle">Interface</span>
			</a>
			<ul id="interface" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'interface' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'upload-items.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('upload-items.index') }}"><i class="align-middle" data-feather="circle"></i>Item Interface</a></li>
				<li class="sidebar-item {{ ($_route_name == 'upload-items.create' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('upload-items.create') }}"><i class="align-middle" data-feather="circle"></i>Item Upload</a></li>
			</ul>
		</li>
	@endcan
	
	@can('viewAdminMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'admin' ? 'active' : '') }}">
			<a data-bs-target="#admin" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-feather="grid"></i> 
				<span class="align-middle">Admin</span>
			</a>
			<ul id="admin" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'admin' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'users.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.index') }}"><i class="align-middle" data-feather="circle"></i>Users</a></li>
				<li class="sidebar-item {{ ($_route_name == 'hierarchies.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('hierarchies.index') }}"><i class="align-middle" data-feather="circle"></i>Hierarchy</a></li>
				<li class="sidebar-item {{ ($_route_name == 'wfs.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('wfs.index') }}"><i class="align-middle" data-feather="circle"></i>Workflow</a></li>
				<li class="sidebar-item {{ ($_route_name == 'activities.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('activities.index') }}"><i class="align-middle" data-feather="circle"></i>Activity Log</a></li>
				<li class="sidebar-item {{ ($_route_name == 'attachments.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('attachments.index') }}"><i class="align-middle" data-feather="circle"></i>Attachments*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'setups.show' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('setups.show',1001) }}"><i class="align-middle" data-feather="circle"></i>Setup</a></li>
			</ul>
		</li>
	@endcan

	@can('viewSystemMenu', App\Models\Tenant\Manage\Menu::class)
		<li class="sidebar-item {{ ($_node_name == 'system' ? 'active' : '') }}">
			<a data-bs-target="#system" data-bs-toggle="collapse" class="sidebar-link collapsed">
				<i class="align-middle" data-feather="grid"></i> 
				<span class="align-middle">System</span>
			</a>
			<ul id="system" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'system' ? 'show' : '') }}" data-bs-parent="#sidebar">
				<li class="sidebar-item {{ ($_route_name == 'tables.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('tables.index') }}"><i class="align-middle" data-feather="circle"></i>Tables</a></li>
				<li class="sidebar-item {{ ($_route_name == 'menus.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('menus.index') }}"><i class="align-middle" data-feather="circle"></i>Menu</a></li>
				<li class="sidebar-item {{ ($_route_name == 'statuses.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('statuses.index') }}"><i class="align-middle" data-feather="circle"></i>Status</a></li>
				<li class="sidebar-item {{ ($_route_name == 'templates.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('templates.index') }}"><i class="align-middle" data-feather="circle"></i>Templates</a></li>
				<li class="sidebar-item {{ ($_route_name == 'entities.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('entities.index') }}"><i class="align-middle" data-feather="circle"></i>Entity</a></li>
				<li class="sidebar-item {{ ($_route_name == 'countries.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('countries.index') }}"><i class="align-middle" data-feather="circle"></i>Country</a></li>
				<li class="sidebar-item {{ ($_route_name == 'prls.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('prls.index') }}"><i class="align-middle" data-feather="circle"></i>Prl*</a></li>
				<li class="sidebar-item {{ ($_route_name == 'groups.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('groups.index') }}"><i class="align-middle" data-feather="circle"></i>Group (?)</a></li>
				<li class="sidebar-item {{ ($_route_name == 'custom-errors.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('custom-errors.index') }}"><i class="align-middle" data-feather="circle"></i>Custom Errors (?)</a></li>
			</ul>
		</li>
	@endcan

	@include('tenant.includes.sidebar-my-account')
	
</ul>
