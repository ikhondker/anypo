<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		@if (auth()->user()->role->value <> UserRoleEnum::USER->value)
			<a class="dropdown-item" href="{{ route('prs.my-prs') }}"><i class="align-middle me-1" data-lucide="user-plus"></i> My Requisitions</a>
		@endif

		<a class="dropdown-item" href="{{ route('prs.index') }}"><i class="align-middle me-1" data-lucide="database"></i> All Requisitions</a>
		<a class="dropdown-item" href="{{ route('prs.index', ['status'=>  App\Enum\Tenant\AuthStatusEnum::INPROCESS->value ]) }}"><i class="align-middle me-1" data-lucide="database"></i> In-Process PR(*)</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Requisition</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('exports.pr') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> * Export Requisitions</a>
		<a class="dropdown-item" href="{{ route('exports.prl') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> * Export Requisitions Lines</a>
	</div>
</div>
