<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'currencies.edit')
			<a class="dropdown-item" href="{{ route('currencies.show', $currency->currency) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Currency</a>
		@endif
		@if (Route::current()->getName() == 'currencies.show')
			@if (auth()->user()->isSystem())
				<a class="dropdown-item" href="{{ route('currencies.edit', $currency->currency) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Currency</a>
			@endif
		@endif

		<a class="dropdown-item" href="{{ route('currencies.index') }}"><i class="align-middle me-1" data-lucide="database"></i> View All</a>

		@can('create', App\Models\Tenant\Lookup\Currency::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('currencies.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Currency</a>
		@endcan

		@can('delete', $currency)
			<div class="dropdown-divider"></div>
			@if ($currency->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('currencies.destroy', $currency->currency) }}"
					data-entity="Currency" data-name="{{ $currency->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Currency">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Currency</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('currencies.destroy', $currency->currency) }}"
					data-entity="Currency" data-name="{{ $currency->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Currency">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Currency</a>
			@endif
		@endcan
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('currencies.timestamp', $currency->currency) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>

	</div>
</div>
