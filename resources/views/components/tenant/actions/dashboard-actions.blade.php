<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Quick Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		
		<a class="dropdown-item" href="{{ route('prs.my-prs') }}"><i class="align-middle me-1" data-feather="user-plus"></i> My Requisitions</a>
		<a class="dropdown-item" href="{{ route('prs.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Requisition</a>
		@can('create', App\Models\Tenant\Po::class)
			<a class="dropdown-item" href="{{ route('pos.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create PO</a>
		@endcan
		@can('create', App\Models\Tenant\Lookup\Supplier::class)
			<a class="dropdown-item" href="{{ route('suppliers.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Supplier</a>
		@endcan
		@can('create', App\Models\Tenant\Lookup\Items::class)
			<a class="dropdown-item" href="{{ route('items.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Item</a>
		@endcan
		<div class="dropdown-divider"></div>
		@can('create', App\Models\Tenant\Admin\User::class)
			<a class="dropdown-item" href="{{ route('users.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create User</a>
		@endcan
		@can('create', App\Models\Tenant\Lookup\Project::class)
			<a class="dropdown-item" href="{{ route('projects.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Project</a>
		@endcan

		@can('viewAny', App\Models\Tenant\Budget::class)
			<a class="dropdown-item" href="{{ route('budgets.index') }}"><i class="align-middle me-1" data-feather="eye"></i> View Budget</a>
		@endcan
		@can('viewAny', App\Models\Tenant\DeptBudget::class)
			<a class="dropdown-item" href="{{ route('dept-budgets.index') }}"><i class="align-middle me-1" data-feather="eye"></i> View Dept Budget</a>
		@endcan

	</div>
</div>