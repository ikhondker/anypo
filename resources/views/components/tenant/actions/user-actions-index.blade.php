<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Users Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('users.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create User</a>
        <a class="dropdown-item" href="{{ route('users.index') }}"><i class="align-middle me-1" data-feather="list"></i> All User's</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('users.export') }}"><i class="align-middle me-1" data-feather="download-cloud"></i> Download User Lists</a>
	</div>
</div>
