<li class="sidebar-item {{ ($_node_name == 'profile' ? 'active' : '') }}">
	<a data-bs-target="#profile" data-bs-toggle="collapse" class="sidebar-link collapsed">
		<i class="align-middle" data-feather="grid"></i> 
		<span class="align-middle">My Account</span>
	</a>
	<ul id="profile" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'profile' ? 'show' : '') }}" data-bs-parent="#sidebar">
		<li class="sidebar-item {{ ($_route_name == 'users.profile' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.profile') }}"><i class="align-middle" data-feather="circle"></i>View Profile</a></li>
		<li class="sidebar-item {{ ($_route_name == 'users.profile-edit' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.profile-edit') }}"><i class="align-middle" data-feather="circle"></i>Edit Profile</a></li>
		<li class="sidebar-item {{ ($_route_name == 'users.profile-password' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.profile-password') }}"><i class="align-middle" data-feather="circle"></i>Change Password</a></li>
	</ul>
</li>

<li class="sidebar-item {{ ($_route_name == 'help' ? 'active' : '') }}">
	<a class="sidebar-link" href="{{ route('help') }}">
		<i class="align-middle" data-feather="help-circle"></i><span class="align-middle">Help</span>
	</a>
</li>
{{-- <li class="sidebar-item {{ ($_route_name == 'tickets.create' ? 'active' : '') }}">
	<a class="sidebar-link" href="{{ route('tickets.create') }}">
		<i class="align-middle" data-feather="message-square"></i><span class="align-middle"> Support</span>
	</a>
</li> --}}
<li class="sidebar-item }}">
	<a class="sidebar-link" href="{{ route('logout') }}">
		<i class="align-middle text-danger" data-feather="power"></i><span class="align-middle"> Logout</span>
	</a>
</li>

@if(session('original_user'))
	<li class="sidebar-item">
		<a class="sidebar-link" href="{{ route('users.leave-impersonate') }}">
			<i class="align-middle text-danger" data-feather="power"></i><span class="align-middle text-danger"> Leave Impersonate</span>
		</a>
	</li>
@endif