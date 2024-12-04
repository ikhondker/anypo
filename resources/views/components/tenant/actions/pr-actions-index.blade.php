<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		@if (auth()->user()->role->value <> UserRoleEnum::USER->value)
			<a class="dropdown-item" href="{{ route('prs.my-prs') }}"><i class="align-middle me-1" data-lucide="user-plus"></i> My Requisitions</a>
		@endif

		<a class="dropdown-item" href="{{ route('prs.index') }}"><i class="align-middle me-1" data-lucide="list"></i> All Requisitions</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Requisition</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.export') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> Download Requisitions</a>
		<a class="dropdown-item" href="{{ route('prls.export') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> Download Requisition Lines</a>

	</div>
</div>
