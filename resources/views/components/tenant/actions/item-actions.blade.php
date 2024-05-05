<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Item Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		
		<a class="dropdown-item" href="{{ route('items.show', $item->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Item</a>
		@can('update', $item)
			<a class="dropdown-item" href="{{ route('items.edit', $item->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Item</a>
		@endcan
		<a class="dropdown-item" href="{{ route('items.index') }}"><i class="align-middle me-1" data-feather="list"></i> Item Lists</a>

		@can('create', App\Models\Tenant\Lookup\Item::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('items.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Item</a>
		@endcan

		@can('delete', $item)
			<div class="dropdown-divider"></div>
			@if ($item->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('items.destroy', $item->id) }}"
					data-entity="Item" data-name="{{ $item->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Item">
					<i class="align-middle me-1 text-danger" data-feather="bell-off"></i> Disable Item</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('items.destroy', $item->id) }}"
					data-entity="Item" data-name="{{ $item->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Item">
					<i class="align-middle me-1 text-success" data-feather="bell"></i> Enable Item</a>
			@endif
		@endcan

	</div>
</div>