<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('projects.show', $project->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Project</a>
		<a class="dropdown-item" href="{{ route('projects.attachments',$project->id) }}"><i class="align-middle me-1" data-lucide="paperclip"></i> Attachments</a>
		@if (Route::current()->getName() == 'projects.show')
			@can('update', $project)
				<a class="dropdown-item" href="{{ route('projects.edit', $project->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Project</a>
			@endcan
		@endif
		@can('spends', App\Models\Tenant\Lookup\Project::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('projects.po', $project->id) }}"><i class="align-middle me-1" data-lucide="list"></i> View Project PO</a>
			<a class="dropdown-item" href="{{ route('projects.budget', $project->id) }}"><i class="align-middle me-1" data-lucide="dollar-sign"></i> Project Budgets</a>
			<a class="dropdown-item" href="{{ route('projects.pbu', $project->id) }}"><i class="align-middle me-1" data-lucide="dollar-sign"></i> Budget Usage</a>
			{{-- <a class="dropdown-item" href="{{ route('projects.spends') }}"><i class="align-middle me-1" data-lucide="pie-chart"></i> Project Spends</a> --}}
		@endcan

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('projects.index') }}"><i class="align-middle me-1" data-lucide="database"></i> Project Lists</a>

		@can('delete', $project)
			<div class="dropdown-divider"></div>
			@if ($project->closed)
				<a class="dropdown-item sw2-advance" href="{{ route('projects.destroy', $project->id) }}"
					data-entity="Project" data-name="{{ $project->name }}" data-status="Open"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Project">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Open Project</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('projects.destroy', $project->id) }}"
					data-entity="Project" data-name="{{ $project->name }}" data-status="Close"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Project">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Close Project</a>
			@endif
		@endcan

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('projects.timestamp', $project->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>


	</div>
</div>
