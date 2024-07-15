<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'templates.edit')
			<a class="dropdown-item" href="{{ route('templates.show', $template->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Template</a>
		@endif
		@if (Route::current()->getName() == 'templates.show')
			<a class="dropdown-item" href="{{ route('templates.edit', $template->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Template</a>
		@endif

		<a class="dropdown-item" href="{{ route('templates.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>

		@can('create', App\Models\Share\Template::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('templates.create') }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Template</a>
		@endcan

		@can('delete', $template)
			<div class="dropdown-divider"></div>
			@if ($template->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('templates.destroy', $template->id) }}"
					data-entity="Template" data-name="{{ $template->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Template">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Template</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('templates.destroy', $template->id) }}"
					data-entity="Template" data-name="{{ $template->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Template">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Template</a>
			@endif
		@endcan

	</div>
</div>
