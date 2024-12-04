<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'statuses.edit')
			<a class="dropdown-item" href="{{ route('statuses.show', $status->code) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Status</a>
		@endif
		@if (Route::current()->getName() == 'statuses.show')
			<a class="dropdown-item" href="{{ route('statuses.edit', $status->code) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Status</a>
		@endif

		<a class="dropdown-item" href="{{ route('statuses.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>

		@can('create', App\Models\Tenant\Manage\Status::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('statuses.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Status</a>
		@endcan

		@can('delete', $status)
			<div class="dropdown-divider"></div>
			@if ($status->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('statuses.destroy', $status->code) }}"
					data-entity="Status" data-name="{{ $status->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Status">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Status</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('statuses.destroy', $status->code) }}"
					data-entity="Status" data-name="{{ $status->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Status">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Status</a>
			@endif
		@endcan

	</div>
</div>
