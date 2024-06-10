

<li class="sidebar-header">
    Navigation
</li>
<li class="sidebar-item {{ $_route_name == 'dashboards.index' ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('dashboards.index') }}">
        <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Home</span>
    </a>
</li>

<li class="sidebar-item {{ $_route_name == 'tickets.create' ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('tickets.create') }}">
        <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Create Ticket</span>
    </a>
</li>

<li class="sidebar-item {{ $_route_name == 'tickets.index' ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('tickets.index') }}">
        <i class="align-middle" data-lucide="home"></i> <span class="align-middle">All Tickets</span>
    </a>
</li>



@if (auth()->user()->role->value == \UserRoleEnum::ADMIN->value)

    <li class="sidebar-header">
        ADMIN
    </li>

    <li class="sidebar-item {{ $_route_name == 'accounts.show' ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('accounts.show') }}">
            <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Accounts</span>
        </a>
    </li>
    <li class="sidebar-item {{ $_route_name == 'invoices.index' ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('invoices.index') }}">
            <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Invoices</span>
        </a>
    </li>

    <li class="sidebar-item {{ $_route_name == 'payments.index' ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('payments.index') }}">
            <i class="align-middle" data-lucide="home"></i> <span class="align-middle">payments</span>
        </a>
    </li>

    <li class="sidebar-item {{ $_route_name == 'users.index' ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('users.index') }}">
            <i class="align-middle" data-lucide="home"></i> <span class="align-middle">users</span>
        </a>
    </li>

	<!-- Nav -->
	<span class="text-cap">ADMIN</span>
	<!-- List -->
	<ul class="nav nav-sm nav-tabs nav-vertical mb-4">
        <li class="sidebar-item {{ $_route_name == 'invoices.index' ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('invoices.generate') }}">
                <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Generate Invoice</span>
            </a>
        </li>
        <li class="sidebar-item {{ $_route_name == 'services.index' ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('services.index') }}">
                <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Buy Users</span>
            </a>
        </li>
        <li class="sidebar-item {{ $_route_name == 'activities.index' ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('activities.generate') }}">
                <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Activity Log</span>
            </a>
        </li>
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
