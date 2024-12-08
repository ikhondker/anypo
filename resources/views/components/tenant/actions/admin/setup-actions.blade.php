<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('setups.show', $setup->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Setup</a>
		<a class="dropdown-item" href="{{ route('setups.edit', $setup->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Setup</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('setups.announcement', $setup->id) }}"><i class="align-middle me-1" data-lucide="info"></i> Announcement</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('setups.tc', $setup->id) }}"><i class="align-middle me-1" data-lucide="align-left"></i> PO Terms & Conditions</a>

		@can('delete', $setup)
			<div class="dropdown-divider"></div>
			@if ($setup->enable)
				<a class="dropdown-item sw2-advance" href="{{ route('setups.destroy', $setup->id) }}"
					data-entity="Setup" data-name="{{ $setup->name }}" data-status="Disable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Disable Setup">
					<i class="align-middle me-1 text-danger" data-lucide="bell-off"></i> Disable Site</a>
			@else
				<a class="dropdown-item sw2-advance" href="{{ route('setups.destroy', $setup->id) }}"
					data-entity="Setup" data-name="{{ $setup->name }}" data-status="Enable"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Enable Setup">
					<i class="align-middle me-1 text-success" data-lucide="bell"></i> Enable Site</a>
			@endif
		@endcan

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('setups.timestamp', $setup->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>
	</div>
</div>
