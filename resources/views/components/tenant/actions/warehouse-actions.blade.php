<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Warehouse Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		
		<a class="dropdown-item" href="{{ route('warehouses.show', $warehouse->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Warehouse</a>
		<a class="dropdown-item" href="{{ route('warehouses.edit', $warehouse->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Warehouse</a>

		@can('create', App\Models\Warehouse::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('warehouses.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Warehouse</a>
		@endcan

		@can('delete', $warehouse)
			<div class="dropdown-divider"></div>
			@if ($warehouse->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('warehouses.destroy', $warehouse->id) }}"
					data-entity="Warehouse" data-name="{{ $warehouse->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Warehouse">
					<i class="align-middle me-1 text-danger" data-feather="bell-off"></i> Disable Warehouse</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('warehouses.destroy', $warehouse->id) }}"
					data-entity="Warehouse" data-name="{{ $warehouse->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Warehouse">
					<i class="align-middle me-1 text-success" data-feather="bell"></i> Enable Warehouse</a>
			@endif
		@endcan

	</div>
</div>