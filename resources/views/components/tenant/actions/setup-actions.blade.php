<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1 text-danger" data-lucide="settings"></i> Setup Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		
		<a class="dropdown-item" href="{{ route('setups.show', $setup->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Setup</a>
		<a class="dropdown-item" href="{{ route('setups.edit', $setup->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Setup</a>
		<a class="dropdown-item" href="{{ route('setups.announcement', $setup->id) }}"><i class="align-middle me-1" data-feather="info"></i> Announcement</a>
		<a class="dropdown-item" href="{{ route('setups.tc', $setup->id) }}"><i class="align-middle me-1" data-feather="align-left"></i> PO Terms & Conditions</a>

	</div>
</div>