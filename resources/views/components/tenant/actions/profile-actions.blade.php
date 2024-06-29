<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-lucide="settings"></i> Profile Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('users.profile') }}"><i class="align-middle me-1" data-feather="eye"></i> View Profile</a>
		<a class="dropdown-item" href="{{ route('users.profile-edit') }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Profile</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('users.profile-password') }}"><i class="align-middle me-1" data-feather="key"></i> Change Password</a>
	</div>
</div>