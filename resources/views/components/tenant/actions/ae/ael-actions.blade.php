<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		{{-- <div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('aels.export') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> Download Data</a> --}}

		@can('manual', $ael)
			<a class="dropdown-item" href="{{ route('aels.manual') }}"><i class="align-middle me-1" data-lucide="eye"></i> Manual Accounting (*)</a>
			<a class="dropdown-item" href="{{ route('aels.index') }}"><i class="align-middle me-1" data-lucide="eye"></i> Manual Accounting (*)</a>
		@endcan
	</div>
</div>
