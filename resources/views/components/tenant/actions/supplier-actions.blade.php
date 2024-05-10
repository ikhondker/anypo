<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Supplier Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		
		<a class="dropdown-item" href="{{ route('suppliers.show', $supplier->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Supplier</a>
		@can('update', $supplier)
			<a class="dropdown-item" href="{{ route('suppliers.edit', $supplier->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Supplier</a>
		@endcan
		<a class="dropdown-item" href="{{ route('suppliers.index') }}"><i class="align-middle me-1" data-feather="list"></i> Supplier List</a>
		
		@can('create', App\Models\Tenant\Lookup\Supplier::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('suppliers.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Supplier</a>
		@endcan
		@can('spends', App\Models\Tenant\Lookup\Supplier::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('suppliers.spends', $supplier->id) }}"><i class="align-middle me-1" data-feather="eye"></i> Supplier Spends</a>
			<a class="dropdown-item" href="{{ route('suppliers.po', $supplier->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Supplier PO</a>
		@endcan 

		@can('delete', $supplier)
			<div class="dropdown-divider"></div>
			@if ($supplier->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('suppliers.destroy', $supplier->id) }}"
					data-entity="Supplier" data-name="{{ $supplier->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Supplier">
					<i class="align-middle me-1 text-danger" data-feather="bell-off"></i> Disable Supplier</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('suppliers.destroy', $supplier->id) }}"
					data-entity="Supplier" data-name="{{ $supplier->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Supplier">
					<i class="align-middle me-1 text-success" data-feather="bell"></i> Enable Supplier</a>
			@endif
		@endcan

	</div>
</div>