<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Invoice Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="{{ route('invoices.my-invoices') }}"><i class="align-middle me-1" data-feather="user-plus"></i> My Invoice's</a>
        <a class="dropdown-item" href="{{ route('invoices.index') }}"><i class="align-middle me-1" data-feather="list"></i> All Invoice's</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('invoices.export') }}"><i class="align-middle me-1" data-feather="download-cloud"></i> Download Invoices to CSV</a>

    </div>
</div>