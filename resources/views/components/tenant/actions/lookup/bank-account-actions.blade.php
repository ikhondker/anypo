<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('bank-accounts.show', $bankAccount->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View BankAccount</a>
		<a class="dropdown-item" href="{{ route('bank-accounts.edit', $bankAccount->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit BankAccount</a>

		@can('create', App\Models\Tenant\Lookup\BankAccount::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('bank-accounts.create') }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create BankAccount</a>
		@endcan

		@can('delete', $bankAccount)
			<div class="dropdown-divider"></div>
			@if ($bankAccount->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('bank-accounts.destroy', $bankAccount->id) }}"
					data-entity="BankAccount" data-name="{{ $bankAccount->ac_name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable BankAccount">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable BankAccount</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('bank-accounts.destroy',$bankAccount->id) }}"
					data-entity="BankAccount" data-name="{{ $bankAccount->ac_name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable BankAccount">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable BankAccount</a>
			@endif
		@endcan

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('bank-accounts.timestamp', $bankAccount->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>


	</div>
</div>
