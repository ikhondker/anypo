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

	</div>
</div>
