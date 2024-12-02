<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">


		@if (Route::current()->getName() == 'warehouses.edit')
		<a class="dropdown-item" href="{{ route('warehouses.show', $warehouse->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Warehouse</a>
		@endif
		@if (Route::current()->getName() == 'warehouses.show')
		<a class="dropdown-item" href="{{ route('warehouses.edit', $warehouse->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Warehouse</a>
		@endif

		<a class="dropdown-item" href="{{ route('warehouses.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>


		@can('create', App\Models\Tenant\Lookup\Warehouse::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('warehouses.create') }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Warehouse</a>
		@endcan

		@can('delete', $warehouse)
			<div class="dropdown-divider"></div>
			@if ($warehouse->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('warehouses.destroy', $warehouse->id) }}"
					data-entity="Warehouse" data-name="{{ $warehouse->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Warehouse">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Warehouse</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('warehouses.destroy', $warehouse->id) }}"
					data-entity="Warehouse" data-name="{{ $warehouse->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Warehouse">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Warehouse</a>
			@endif
		@endcan

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('warehouses.timestamp', $warehouse->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>


	</div>
</div>
