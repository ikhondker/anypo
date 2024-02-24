<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> PO Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		
		<a class="dropdown-item" href="{{ route('pos.export') }}"><i class="align-middle me-1" data-feather="eye"></i> Download PO to CSV</a>
		<a class="dropdown-item" href="{{ route('pols.export') }}"><i class="align-middle me-1" data-feather="eye"></i> Download PO Lines to CSV</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('pos.create') }}"><i class="align-middle me-1" data-feather="eye"></i> Create PO</a>
	
	</div>
</div>