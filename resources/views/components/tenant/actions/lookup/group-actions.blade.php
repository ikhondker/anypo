<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'groups.edit')
			<a class="dropdown-item" href="{{ route('groups.show', $group->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Group</a>
		@endif
		@if (Route::current()->getName() == 'groups.show')
			<a class="dropdown-item" href="{{ route('groups.edit', $group->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Group</a>
		@endif

		<a class="dropdown-item" href="{{ route('groups.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>

		@can('create', App\Models\Tenant\Lookup\Group::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('groups.create') }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Group</a>
		@endcan

		@can('delete', $group)
			<div class="dropdown-divider"></div>
			@if ($group->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('groups.destroy', $group->id) }}"
					data-entity="Group" data-name="{{ $group->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Group">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Group</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('groups.destroy', $group->id) }}"
					data-entity="Group" data-name="{{ $group->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Group">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Group</a>
			@endif
		@endcan

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('groups.timestamp', $group->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>


	</div>
</div>
