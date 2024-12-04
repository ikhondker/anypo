<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'oems.edit')
			<a class="dropdown-item" href="{{ route('oems.show', $oem->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View OEM</a>
		@endif
		@if (Route::current()->getName() == 'oems.show')
			<a class="dropdown-item" href="{{ route('oems.edit', $oem->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit OEM</a>
		@endif

		<a class="dropdown-item" href="{{ route('oems.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>

		@can('create', App\Models\Tenant\Lookup\Oem::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('oems.create') }}"><i class="align-middle me-1" data-lucide="plus"></i> Create OEM</a>
		@endcan

		@can('delete', $oem)
			<div class="dropdown-divider"></div>
			@if ($oem->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('oems.destroy', $oem->id) }}"
					data-entity="OEM" data-name="{{ $oem->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable OEM">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable OEM</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('oems.destroy', $oem->id) }}"
					data-entity="OEM" data-name="{{ $oem->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable OEM">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable OEM</a>
			@endif
		@endcan

                <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('oems.timestamp', $oem->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>


	</div>
</div>
