<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Project Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('projects.edit', $id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Project</a>
        <a class="dropdown-item" href="{{ route('projects.budget', $project->id) }}"><i class="align-middle me-1" data-feather="dollar-sign"></i> Budget Usage</a>
		<a class="dropdown-item" href="{{ route('projects.edit', $id) }}"><i class="align-middle me-1" data-feather="lock"></i> Close Project *</a>
        <a class="dropdown-item" href="{{ route('projects.attachments',$id) }}"><i class="align-middle me-1" data-feather="paperclip"></i> Attachments</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.export') }}"><i class="align-middle me-1" data-feather="download-cloud"></i> Download Requisitions</a>
		<a class="dropdown-item" href="{{ route('prls.export') }}"><i class="align-middle me-1" data-feather="download-cloud"></i> Download Requisition Lines</a>
	</div>
</div>