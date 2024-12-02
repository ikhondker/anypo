<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'depts.edit')
			<a class="dropdown-item" href="{{ route('depts.show', $dept->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Dept</a>
		@endif
		@if (Route::current()->getName() == 'depts.show')
			<a class="dropdown-item" href="{{ route('depts.edit', $dept->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Dept</a>
		@endif

		<a class="dropdown-item" href="{{ route('depts.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>

		@can('create', App\Models\Tenant\Lookup\Dept::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('depts.create') }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Dept</a>
		@endcan

		@can('delete', $dept)
			<div class="dropdown-divider"></div>
			@if ($dept->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('depts.destroy', $dept->id) }}"
					data-entity="Dept" data-name="{{ $dept->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Dept">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Dept</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('depts.destroy', $dept->id) }}"
					data-entity="Dept" data-name="{{ $dept->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Dept">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Dept</a>
			@endif
		@endcan

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('depts.timestamp', $dept->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>
	</div>
</div>
