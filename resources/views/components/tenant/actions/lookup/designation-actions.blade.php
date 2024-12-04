<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'designations.edit')
			<a class="dropdown-item" href="{{ route('designations.show', $designation->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Designation</a>
		@endif
		@if (Route::current()->getName() == 'designations.show')
			<a class="dropdown-item" href="{{ route('designations.edit', $designation->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Designation</a>
		@endif

		<a class="dropdown-item" href="{{ route('designations.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>

		@can('create', App\Models\Tenant\Lookup\Designation::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('designations.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Designation</a>
		@endcan

		@can('delete', $designation)
			<div class="dropdown-divider"></div>
			@if ($designation->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('designations.destroy', $designation->id) }}"
					data-entity="Designation" data-name="{{ $designation->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Designation">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Designation</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('designations.destroy', $designation->id) }}"
					data-entity="Designation" data-name="{{ $designation->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Designation">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Designation</a>
			@endif
		@endcan

                <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('designations.timestamp', $designation->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>


	</div>
</div>
