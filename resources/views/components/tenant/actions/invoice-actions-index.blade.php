<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('invoices.my-invoices') }}"><i class="align-middle me-1" data-lucide="user-plus"></i> My Invoice's</a>
		<a class="dropdown-item" href="{{ route('invoices.index') }}"><i class="align-middle me-1" data-lucide="database"></i> All Invoice's</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('exports.invoice') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> * Export Invoices</a>
		<a class="dropdown-item" href="{{ route('exports.invoice-line') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> * Export Invoices Lines</a>
	</div>
</div>
