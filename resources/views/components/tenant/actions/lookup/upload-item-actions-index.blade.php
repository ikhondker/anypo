<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{asset('downloads/anypo-bulk-item-upload-template-v1.xlsx') }}"><i class="align-middle me-1" data-lucide="download"></i>1. Download Templates</a>
		<a class="dropdown-item" href="{{ route('upload-items.create') }}"><i class="align-middle me-1" data-lucide="upload"></i> 2. Upload File</a>

		<div class="dropdown-divider"></div>
		<a href="{{ route('upload-items.check') }}" class="dropdown-item sw2-advance"
			data-entity="" data-name="Validation Process" data-status="Run"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Validate">
			<i class="align-middle me-1" data-lucide="check"></i> 3. Validate</a>
			
		<a href="{{ route('upload-items.import') }}" class="dropdown-item sw2-advance"
			data-entity="" data-name="Import Process" data-status="Run"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Validate">
			<i class="align-middle me-1" data-lucide="upload-cloud"></i> 4. Import</a>

			<div class="dropdown-divider"></div>
		<a href="{{ route('upload-items.purge') }}" class="dropdown-item sw2-advance"
			data-entity="" data-name="Purge" data-status="Run"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Validate">
			<i class="align-middle me-1 text-danger" data-lucide="minus-circle"></i> 5. Purge</a>
	</div>
</div>
