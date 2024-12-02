<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'item-categories.show')
			<a class="dropdown-item" href="{{ route('item-categories.edit', $itemCategory->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Category</a>
		@endif
		@if (Route::current()->getName() == 'item-categories.edit')
			<a class="dropdown-item" href="{{ route('item-categories.show', $itemCategory->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Category</a>
		@endif

		<a class="dropdown-item" href="{{ route('item-categories.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>


		@can('create', App\Models\Tenant\Lookup\Dept::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('item-categories.create') }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Category</a>
		@endcan

		@can('delete', $itemCategory)
			<div class="dropdown-divider"></div>
			@if ($itemCategory->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('item-categories.destroy', $itemCategory->id) }}"
					data-entity="Category" data-name="{{ $itemCategory->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Category">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Category</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('item-categories.destroy', $itemCategory->id) }}"
					data-entity="Category" data-name="{{ $itemCategory->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Category">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Category</a>
			@endif
		@endcan

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('item-categories.timestamp', $itemCategory->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>


	</div>
</div>
