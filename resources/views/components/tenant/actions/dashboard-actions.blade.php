<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('prs.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Requisition</a>
		<a class="dropdown-item" href="{{ route('prs.my-prs') }}"><i class="align-middle me-1" data-lucide="user-plus"></i> My Requisitions</a>

		@if (auth()->user()->isBuyer())
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('pos.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Purchase Order</a>
			<a class="dropdown-item" href="{{ route('pos.my-pos') }}"><i class="align-middle me-1" data-lucide="user-plus"></i> My Purchase Orders</a>
		@endif

		<div class="dropdown-divider"></div>
		@can('create', App\Models\Tenant\Lookup\Item::class)
			<a class="dropdown-item" href="{{ route('items.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Item</a>
		@endcan
		@can('create', App\Models\Tenant\Lookup\Supplier::class)
			<a class="dropdown-item" href="{{ route('suppliers.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Supplier</a>
		@endcan
		@can('create', App\Models\Tenant\Lookup\Project::class)
			<a class="dropdown-item" href="{{ route('projects.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Project</a>
		@endcan
		@can('create', App\Models\Tenant\Admin\User::class)
		<a class="dropdown-item" href="{{ route('users.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create User</a>
		@endcan
		@can('viewAny', App\Models\Tenant\Budget::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('budgets.index') }}"><i class="align-middle me-1" data-lucide="eye"></i> View Budget</a>
		@endcan
		@can('viewAny', App\Models\Tenant\DeptBudget::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('dept-budgets.index') }}"><i class="align-middle me-1" data-lucide="eye"></i> View Dept Budget</a>
		@endcan

	</div>
</div>
