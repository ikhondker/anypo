<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> User Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		
		<a class="dropdown-item" href="{{ route('users.show', $user->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Profile</a>
		<a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit User</a>
		<a class="dropdown-item" href="{{ route('users.password', $user->id) }}"><i class="align-middle me-1" data-feather="key"></i> Change Password</a>

		@can('create', App\Models\User::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('users.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create User</a>
		@endcan

		@can('delete', $user)
			<div class="dropdown-divider"></div>
			@if ($user->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('users.destroy', $id) }}"
					data-entity="User" data-name="{{ $user->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable User">
					<i class="align-middle me-1 text-danger" data-feather="bell-off"></i> Disable User</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('users.destroy', $id) }}"
					data-entity="User" data-name="{{ $user->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable User">
					<i class="align-middle me-1 text-success" data-feather="bell"></i> Enable User</a>
			@endif
		@endcan

	</div>
</div>