<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'uoms.edit')
			<a class="dropdown-item" href="{{ route('uoms.show', $uom->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View UoM</a>
		@endif
		@if (Route::current()->getName() == 'uoms.show')
			<a class="dropdown-item" href="{{ route('uoms.edit', $uom->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit UoM</a>
		@endif

		<a class="dropdown-item" href="{{ route('uoms.index') }}"><i class="align-middle me-1" data-lucide="database"></i> View All</a>

		@can('create', App\Models\Tenant\Lookup\Uom::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('uoms.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create UoM</a>
		@endcan

		@can('delete', $uom)
			<div class="dropdown-divider"></div>
			@if ($uom->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('uoms.destroy', $uom->id) }}"
					data-entity="UoM" data-name="{{ $uom->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable UoM">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable UoM</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('uoms.destroy', $uom->id) }}"
					data-entity="UoM" data-name="{{ $uom->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable UoM">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable UoM</a>
			@endif
		@endcan

			<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('uoms.timestamp', $uom->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>

	</div>
</div>
