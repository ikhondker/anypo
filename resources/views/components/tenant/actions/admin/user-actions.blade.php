<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">


		@if (Route::current()->getName() == 'users.edit')
			<a class="dropdown-item" href="{{ route('users.show', $user->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Profile</a>
		@endif
		@if (Route::current()->getName() == 'users.show')
			<a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit User</a>
		@endif
		<a class="dropdown-item" href="{{ route('users.password-change', $user->id) }}"><i class="align-middle me-1" data-lucide="key"></i> Change Password</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('users.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>

		@can('create', App\Models\User::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('users.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create User</a>
		@endcan


		@can('delete', $user)
			<div class="dropdown-divider"></div>
			@if ($user->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('users.destroy', $user->id) }}"
					data-entity="User" data-name="{{ $user->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable User">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable User</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('users.destroy', $user-s>id) }}"
					data-entity="User" data-name="{{ $user->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable User">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable User</a>
			@endif
		@endcan

	</div>
</div>
