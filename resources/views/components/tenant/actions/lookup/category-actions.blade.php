<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'categories.show')
			<a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Category</a>
		@endif
		@if (Route::current()->getName() == 'categories.edit')
			<a class="dropdown-item" href="{{ route('categories.show', $category->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Category</a>
		@endif

		<a class="dropdown-item" href="{{ route('categories.index') }}"><i class="align-middle me-1" data-lucide="database"></i> View All</a>


		@can('create', App\Models\Tenant\Lookup\Category::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('categories.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Category</a>
		@endcan

		@can('delete', $category)
			<div class="dropdown-divider"></div>
			@if ($category->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('categories.destroy', $category->id) }}"
					data-entity="Category" data-name="{{ $category->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Category">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Category</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('categories.destroy', $category->id) }}"
					data-entity="Category" data-name="{{ $category->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Category">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Category</a>
			@endif
		@endcan

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('categories.timestamp', $category->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>


	</div>
</div>
