<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-danger mt-n1" data-lucide="settings"></i> {{ $account->name }}
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('accounts.show', $account->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Account</a>
		<a class="dropdown-item" href="{{ route('invoices.all',$account->id) }}"><i class="align-middle me-1" data-lucide="list"></i> View Invoices</a>
		<a class="dropdown-item" href="{{ route('payments.all',$account->id) }}"><i class="align-middle me-1" data-lucide="list"></i> View Payments</a>
		<a class="dropdown-item" href="{{ route('services.all',$account->id) }}"><i class="align-middle me-1" data-lucide="list"></i> View Services</a>
		<a class="dropdown-item" href="{{ route('users.all',$account->id) }}"><i class="align-middle me-1" data-lucide="list"></i> View Users</a>
		<a class="dropdown-item" href="{{ route('invoices.generate') }}"></i><i class="align-middle me-1 fas fa-dollar-sign"></i> Generate Invoice ***</a>
        @if (auth()->user()->isSystem())
            <a class="dropdown-item text-danger" href="{{ route('users.all',$account->id) }}"><i class="align-middle me-1 text-danger" data-lucide="list"></i> Lifetime Discount (*)</a>
        @endif
	</div>
</div>
