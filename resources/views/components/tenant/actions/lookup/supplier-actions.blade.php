<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'suppliers.edit')
			<a class="dropdown-item" href="{{ route('suppliers.show', $supplier->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Supplier</a>
		@endif
		@if (Route::current()->getName() == 'suppliers.show')
			@can('update', $supplier)
				<a class="dropdown-item" href="{{ route('suppliers.edit', $supplier->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Supplier</a>
			@endcan
		@endif
		@can('spends', App\Models\Tenant\Lookup\Supplier::class)
			<a class="dropdown-item" href="{{ route('suppliers.po', $supplier->id) }}"><i class="align-middle me-1" data-lucide="list"></i> View Supplier PO</a>
			<a class="dropdown-item" href="{{ route('suppliers.spends') }}"><i class="align-middle me-1" data-lucide="pie-chart"></i> Supplier Spends</a>
		@endcan

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('suppliers.index') }}"><i class="align-middle me-1" data-lucide="database"></i> View All</a>

		@can('create', App\Models\Tenant\Lookup\Supplier::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('suppliers.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Supplier</a>
		@endcan


		@can('delete', $supplier)
			<div class="dropdown-divider"></div>
			@if ($supplier->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('suppliers.destroy', $supplier->id) }}"
					data-entity="Supplier" data-name="{{ $supplier->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Supplier">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Supplier</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('suppliers.destroy', $supplier->id) }}"
					data-entity="Supplier" data-name="{{ $supplier->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Supplier">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Supplier</a>
			@endif
		@endcan


		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('suppliers.timestamp', $supplier->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>

	</div>
</div>
