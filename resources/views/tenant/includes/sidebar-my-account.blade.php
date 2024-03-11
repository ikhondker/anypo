<li class="sidebar-item {{ ($_node_name == 'profile' ? 'active' : '') }}">
	<a data-bs-target="#profile" data-bs-toggle="collapse" class="sidebar-link collapsed">
		<i class="align-middle" data-feather="grid"></i> 
		<span class="align-middle">My Account</span>
	</a>
	<ul id="profile" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'profile' ? 'show' : '') }}" data-bs-parent="#sidebar">
		<li class="sidebar-item {{ ($_route_name == 'users.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.show',auth()->user()->id) }}"><i class="align-middle" data-feather="circle"></i>View Profile</a></li>
		<li class="sidebar-item {{ ($_route_name == 'suppliers.index' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.password',Auth::user()->id) }}"><i class="align-middle" data-feather="circle"></i>Change Password</a></li>
	</ul>
</li>

<li class="sidebar-item {{ ($_route_name == 'help' ? 'active' : '') }}">
	<a class="sidebar-link" href="{{ route('help') }}">
		<i class="align-middle" data-feather="help-circle"></i><span class="align-middle">Help & Support</span>
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