<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'countries.edit')
			<a class="dropdown-item" href="{{ route('countries.show', $country->country) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Country</a>
		@endif
		@if (Route::current()->getName() == 'countries.show')
			<a class="dropdown-item" href="{{ route('countries.edit', $country->country) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Country</a>
		@endif

		<a class="dropdown-item" href="{{ route('countries.index') }}"><i class="align-middle me-1" data-lucide="database"></i> View All</a>

		@can('create', App\Models\Tenant\Lookup\Country::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('countries.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Country</a>
		@endcan

		@can('delete', $country)
			<div class="dropdown-divider"></div>
			@if ($country->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('countries.destroy', $country->country) }}"
					data-entity="Country" data-name="{{ $country->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Country">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Country</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('countries.destroy', $country->country) }}"
					data-entity="Country" data-name="{{ $country->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Country">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Country</a>
			@endif
		@endcan

	</div>
</div>
