<li class="sidebar-header">
	Account
</li>

<li class="sidebar-item {{ $_route_name == 'users.profile' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('users.profile') }}">
		<i class="align-middle" data-lucide="user"></i> <span class="align-middle">View Profile</span>
	</a>
</li>

<li class="sidebar-item {{ $_route_name == 'users.profile-password' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('users.profile-password') }}">
		<i class="align-middle" data-lucide="key"></i> <span class="align-middle">Change Password</span>
	</a>
</li>

<li class="sidebar-item {{ $_route_name == 'users.profile-edit' ? 'active' : '' }}">
	<a class="sidebar-link" href="{{ route('users.profile-edit') }}">
		<i class="align-middle" data-lucide="user"></i> <span class="align-middle">Edit Profile</span>
	</a>
</li>

<li class="sidebar-item">
	<a class="sidebar-link" href="{{ route('logout') }}">
		<i class="align-middle text-danger" data-lucide="power"></i> <span class="align-middle">Sign out</span>
	</a>
</li>

@if(session('original_user'))
	<li class="sidebar-item">
		<a class="sidebar-link" href="{{ route('users.leave-impersonate') }}">
			<i class="align-middle" data-lucide="log-out"></i> <span class="align-middle">Leave Impersonate</span>
		</a>
	</li>
@endif
