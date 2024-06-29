<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-lucide="settings"></i> PR Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('prs.my-prs') }}"><i class="align-middle me-1" data-feather="user-plus"></i> My Requisitions</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Requisition</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.export') }}"><i class="align-middle me-1" data-feather="download-cloud"></i> Download Requisitions</a>
		<a class="dropdown-item" href="{{ route('prls.export') }}"><i class="align-middle me-1" data-feather="download-cloud"></i> Download Requisition Lines</a>

	</div>
</div>
