<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-lucide="settings"></i> BankAccount Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		
		<a class="dropdown-item" href="{{ route('bank-accounts.show', $bankAccount->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View BankAccount</a>
		<a class="dropdown-item" href="{{ route('bank-accounts.edit', $bankAccount->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit BankAccount</a>

		@can('create', App\Models\Tenant\Lookup\BankAccount::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('bank-accounts.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create BankAccount</a>
		@endcan

		@can('delete', $bankAccount)
			<div class="dropdown-divider"></div>
			@if ($bankAccount->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('bank-accounts.destroy', $id) }}"
					data-entity="BankAccount" data-name="{{ $bankAccount->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable BankAccount">
					<i class="align-middle me-1 text-danger" data-feather="bell-off"></i> Disable BankAccount</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('bank-accounts.destroy', $id) }}"
					data-entity="BankAccount" data-name="{{ $bankAccount->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable BankAccount">
					<i class="align-middle me-1 text-success" data-feather="bell"></i> Enable BankAccount</a>
			@endif
		@endcan

	</div>
</div>