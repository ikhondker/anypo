<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-lucide="settings"></i> Payment Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="{{ route('payments.my-payments') }}"><i class="align-middle me-1" data-feather="user-plus"></i> My Payment's</a>
        <a class="dropdown-item" href="{{ route('payments.index') }}"><i class="align-middle me-1" data-feather="list"></i> All Payment's</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('payments.export') }}"><i class="align-middle me-1" data-feather="download-cloud"></i> Download Payments to CSV</a>

    </div>
</div>
