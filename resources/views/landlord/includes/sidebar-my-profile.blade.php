
<li class="sidebar-item {{ ($_node_name == 'profile' ? 'active' : '') }}">
	<a data-bs-target="#profile" data-bs-toggle="collapse" class="sidebar-link collapsed">
		<i class="align-middle" data-lucide="layout-template"></i>
		<span class="align-middle">My Profile</span>
	</a>
	<ul id="profile" class="sidebar-dropdown list-unstyled collapse {{ ($_node_name == 'profile' ? 'show' : '') }}" data-bs-parent="#sidebar">
		<li class="sidebar-item {{ ($_route_name == 'users.profile' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.profile') }}"><i class="align-middle" data-lucide="circle"></i>View Profile</a></li>
		<li class="sidebar-item {{ ($_route_name == 'users.profile-edit' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.profile-edit') }}"><i class="align-middle" data-lucide="circle"></i>Edit Profile</a></li>
		<li class="sidebar-item {{ ($_route_name == 'users.profile-password' ? 'active' : '') }}"><a class="sidebar-link" href="{{ route('users.profile-password') }}"><i class="align-middle" data-lucide="circle"></i>Change Password</a></li>
		
	</ul>
</li>
@if(session('original_user'))
	<li class="sidebar-item">
		<a class="sidebar-link" href="{{ route('users.leave-impersonate') }}">
			<i class="align-middle text-danger" data-lucide="log-out"></i><span class="align-middle"> Leave Impersonate</span>
		</a>
	</li>
@else 
	<li class="sidebar-item">
		<a class="sidebar-link" href="{{ route('logout') }}">
			<i class="align-middle text-danger" data-lucide="power"></i> <span class="align-middle"> Sign out</span>
		</a>
	</li>
@endif
