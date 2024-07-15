<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'custom-errors.edit')
			<a class="dropdown-item" href="{{ route('custom-errors.show', $customError->code) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Custom Error</a>
		@endif
		@if (Route::current()->getName() == 'custom-errors.show')
			<a class="dropdown-item" href="{{ route('custom-errors.edit', $customError->code) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Custom Error</a>
		@endif

		<a class="dropdown-item" href="{{ route('custom-errors.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>

		@can('create', App\Models\Tenant\Manage\CustomError::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('custom-errors.create') }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Custom Error</a>
		@endcan

		@can('delete', $customError)
			<div class="dropdown-divider"></div>
			@if ($customError->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('custom-errors.destroy', $customError->code) }}"
					data-entity="Custom Error" data-name="{{ $customError->name }}" data-customError="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Custom Error">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Custom Error</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('custom-errors.destroy', $customError->code) }}"
					data-entity="Custom Error" data-name="{{ $customError->name }}" data-customError="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Custom Error">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Custom Error</a>
			@endif
		@endcan

	</div>
</div>
