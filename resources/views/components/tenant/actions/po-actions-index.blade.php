<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('pos.my-pos') }}"><i class="align-middle me-1" data-lucide="user-plus"></i> My Purchase Orders</a>
		<a class="dropdown-item" href="{{ route('pos.index') }}"><i class="align-middle me-1" data-lucide="database"></i> All Purchase Orders</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('pos.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Purchase Order</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('exports.po') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> * Export PO</a>
		<a class="dropdown-item" href="{{ route('exports.pol') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> * Export PO Lines</a>
	</div>
</div>
