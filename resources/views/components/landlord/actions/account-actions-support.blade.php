<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-danger mt-n1" data-lucide="settings"></i> {{ $account->name }}
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('accounts.edit', $account->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Account</a>
		<a class="dropdown-item" href="{{ route('accounts.show', $account->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Account</a>
		<a class="dropdown-item" href="{{ route('invoices.all',$account->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Invoices</a>
		<a class="dropdown-item" href="{{ route('payments.all',$account->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Payments</a>
		<a class="dropdown-item" href="{{ route('services.all',$account->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Services</a>
		<a class="dropdown-item" href="{{ route('users.all',$account->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Users</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('accounts.all') }}"><i class="align-middle me-1" data-lucide="database"></i> View All</a>

		@if (auth()->user()->isSystem())
			<div class="dropdown-divider"></div>
			@if ( $account->tenant_enable)
				<a class="dropdown-item sw2-advance" href="{{ route('accounts.tenant', $account->id) }}"
					data-entity="Tenant" data-name="{{ $account->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Tenant">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Tenant</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('accounts.tenant', $account->id) }}"
					data-entity="Tenant" data-name="{{ $account->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Tenant">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Tenant</a>
			@endif

			<div class="dropdown-divider"></div>
			<a class="dropdown-item text-danger" href="{{ route('accounts.edit',$account->id) }}"><i class="align-middle me-1 text-danger" data-lucide="dollar-sign"></i> Lifetime Discount</a>
			<a class="dropdown-item text-danger sw2" href="{{ route('accounts.reset',$account->id) }}"><i class="align-middle me-1 text-danger" data-lucide="rotate-ccw"></i> Account Reset (*)</a>
			<a class="dropdown-item text-danger sw2" href="{{ route('accounts.delete',$account->id) }}"><i class="align-middle me-1 text-danger" data-lucide="delete"></i> Delete Account (*)</a>
		@endif
	</div>
</div>
