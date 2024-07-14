<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'menus.edit')
			<a class="dropdown-item" href="{{ route('menus.show', $menu->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View menu</a>
		@endif
		@if (Route::current()->getName() == 'menus.show')
			<a class="dropdown-item" href="{{ route('menus.edit', $menu->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit menu</a>
		@endif

		<a class="dropdown-item" href="{{ route('menus.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>

		@can('create', App\Models\Tenant\Manage\Menu::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('menus.create') }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create menu</a>
		@endcan

		@can('delete', $menu)
			<div class="dropdown-divider"></div>
			@if ($menu->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('menus.destroy', $menu->id) }}"
					data-entity="menu" data-name="{{ $menu->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable menu">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable menu</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('menus.destroy', $menu->id) }}"
					data-entity="menu" data-name="{{ $menu->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable menu">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable menu</a>
			@endif
		@endcan

	</div>
</div>
