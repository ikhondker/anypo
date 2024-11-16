<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('accounts.show', $account->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Account</a>
		<a class="dropdown-item" href="{{ route('invoices.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View Invoices</a>
		<a class="dropdown-item" href="{{ route('payments.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View Payments</a>
		<a class="dropdown-item" href="{{ route('users.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View Users</a>
		<a class="dropdown-item" href="{{ route('invoices.generate') }}"></i><i class="align-middle me-1 fas fa-dollar-sign"></i> Generate Invoice</a>
		<a class="dropdown-item" href="{{ route('services.index') }}"><i class="align-middle me-1" data-lucide="shopping-cart"></i> Buy Users</a>
	</div>
</div>
