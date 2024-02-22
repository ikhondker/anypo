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

	<li class="sidebar-item {{ ($_route_name == 'prs.index' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('prs.index') }}">
			<i class="align-middle" data-feather="layout"></i><span class="align-middle">Requisition*</span>
		</a>
	</li>

	<li class="sidebar-item {{ ($_route_name == 'items.index' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('items.index') }}">
			<i class="align-middle" data-feather="layout"></i><span class="align-middle">Items</span>
		</a>
	</li>

	<li class="sidebar-item {{ ($_route_name == 'suppliers.index' ? 'active' : '') }}">
		<a class="sidebar-link" href="{{ route('suppliers.index') }}">
			<i class="align-middle" data-feather="layout"></i><span class="align-middle">Suppliers</span>
		</a>
	</li>

	@include('tenant.includes.sidebar.my-account')

</ul>
