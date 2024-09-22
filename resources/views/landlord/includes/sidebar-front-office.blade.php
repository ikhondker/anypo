<li class="sidebar-item {{ ($_route_name == 'home' ? 'active' : '') }}">
	<a class="sidebar-link" href="{{ route('home') }}">
		<i class="align-middle" data-lucide="home"></i><span class="align-middle">Home</span>
	</a>
</li>

<li class="sidebar-item {{ $_route_name == 'dashboards.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('dashboards.index') }}">
		<i class="align-middle" data-lucide="sliders"></i> <span class="align-middle">Dashboards</span>
	</a>
</li>

{{-- <li class="sidebar-item {{ $_route_name == 'tickets.create' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('tickets.create') }}">
		<i class="align-middle" data-lucide="plus-circle"></i> <span class="align-middle">Create Ticket</span>
	</a>
</li> --}}

<li class="sidebar-item {{ $_route_name == 'tickets.index' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('tickets.index') }}">
		<i class="align-middle" data-lucide="list"></i> <span class="align-middle">All Tickets</span>
	</a>
</li>


@can('viewAdminMenu', App\Models\Landlord\Manage\Menu::class)
	<li class="sidebar-item {{ ($_node_name == 'workbench' ? 'active' : '') }}">
		<a data-bs-target="#workbench" data-bs-toggle="collapse" class="sidebar-link collapsed">
			<i class="align-middle" data-lucide="layout-template"></i>
			<span class="align-middle">Admin</span>
		</a>
		<ul id="workbench" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'workbench' ? 'show' : '') }}" data-bs-parent="#sidebar">
			<li class="sidebar-item {{ ($_route_name == 'accounts.show' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('accounts.show',auth()->user()->account_id) }}"><i class="align-middle" data-lucide="circle"></i>Account</a></li>
			<li class="sidebar-item {{ ($_route_name == 'invoices.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('invoices.index') }}"><i class="align-middle" data-lucide="circle"></i>All Invoices</a></li>
			<li class="sidebar-item {{ ($_route_name == 'payments.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('payments.index') }}"><i class="align-middle" data-lucide="circle"></i>All Payments</a></li>
			<li class="sidebar-item {{ ($_route_name == 'users.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.index') }}"><i class="align-middle" data-lucide="circle"></i>All Users</a></li>
			<li class="sidebar-item {{ ($_route_name == 'services.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('services.index') }}"><i class="align-middle" data-lucide="circle"></i>Buy Users</a></li>
			<li class="sidebar-item {{ ($_route_name == 'invoices.generate' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('invoices.generate') }}"><i class="align-middle" data-lucide="circle"></i>Generate Invoice</a></li>
		</ul>
	</li>
@endcan



<!-- ========== Profile ========== -->
@include('landlord.includes.sidebar-my-profile')
<!-- ========== End Profile ========== -->
