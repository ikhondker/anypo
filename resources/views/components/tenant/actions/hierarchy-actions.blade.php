<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-lucide="settings"></i> Hierarchy Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		
		<a class="dropdown-item" href="{{ route('hierarchies.show', $hierarchy->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Hierarchy</a>
		<a class="dropdown-item" href="{{ route('hierarchies.edit', $hierarchy->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Hierarchy</a>
		<a class="dropdown-item" href="{{ route('hierarchies.index') }}"><i class="align-middle me-1" data-feather="list"></i> Hierarchy List</a>

		@can('create', App\Models\Tenant\Workflow\Hierarchy::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('hierarchies.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Hierarchy</a>
		@endcan

		
		@can('delete', $hierarchy)
			<div class="dropdown-divider"></div>
			@if ($hierarchy->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('hierarchies.destroy', $hierarchy->id) }}"
					data-entity="Hierarchy" data-name="{{ $hierarchy->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Hierarchy">
					<i class="align-middle me-1 text-danger" data-feather="bell-off"></i> Disable Hierarchy</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('hierarchies.destroy', $hierarchy->id) }}"
					data-entity="Hierarchy" data-name="{{ $hierarchy->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Hierarchy">
					<i class="align-middle me-1 text-success" data-feather="bell"></i> Enable Hierarchy</a>
			@endif
		@endcan

	</div>
</div>