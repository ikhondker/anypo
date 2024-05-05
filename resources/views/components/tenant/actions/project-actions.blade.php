<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Project Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('projects.show', $project->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Project</a>
		@can('update', $project)
			<a class="dropdown-item" href="{{ route('projects.edit', $project->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Project</a>
		@endcan

		<a class="dropdown-item" href="{{ route('projects.attachments',$project->id) }}"><i class="align-middle me-1" data-feather="paperclip"></i> Attachments</a>
		<a class="dropdown-item" href="{{ route('projects.index') }}"><i class="align-middle me-1" data-feather="list"></i> Project Lists</a>

		@can('spends', App\Models\Tenant\Lookup\Project::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('projects.spends', $project->id) }}"><i class="align-middle me-1" data-feather="eye"></i> Project Spends</a>
			<a class="dropdown-item" href="{{ route('projects.po', $project->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Project PO</a>
			<a class="dropdown-item" href="{{ route('projects.budget', $project->id) }}"><i class="align-middle me-1" data-feather="dollar-sign"></i> Budget Usage</a>
		@endcan 

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('projects.export') }}"><i class="align-middle me-1" data-feather="download-cloud"></i> Download Projects</a>

		@can('delete', $project)
			<div class="dropdown-divider"></div>
			@if ($project->closed)
				<a class="dropdown-item sw2-advance" href="{{ route('projects.destroy', $project->id) }}"
					data-entity="Project" data-name="{{ $project->name }}" data-status="Open"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Project">
					<i class="align-middle me-1 text-danger" data-feather="bell-off"></i> Open Project</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('projects.destroy', $project->id) }}"
					data-entity="Project" data-name="{{ $project->name }}" data-status="Close"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Project">
					<i class="align-middle me-1 text-success" data-feather="bell"></i> Close Project</a>
			@endif
		@endcan

	</div>
</div>