<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-danger mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		@if (auth()->user()->isSys())
			<a class="dropdown-item text-danger" href="{{ route('invoices.edit', $invoice->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit</a>
			<a class="dropdown-item text-danger" href="{{ route('invoices.pwop', $invoice->id) }}"><i class="align-middle me-1" data-lucide="dollar-sign"></i> Pay without Pay (*)</a>
			<a class="dropdown-item text-danger" href="{{ route('invoices.discount', $invoice->id) }}"><i class="align-middle me-1" data-lucide="dollar-sign"></i> Apply Discount (*)</a>
			<a class="dropdown-item text-danger sw2" href="{{ route('invoices.post', $invoice->id) }}"><i class="align-middle me-1" data-lucide="dollar-sign"></i> Post (*)</a>
		@endif
		<a class="dropdown-item" href="{{ route('invoices.all') }}"><i class="align-middle me-1" data-lucide="eye"></i> View All(*)</a>
	</div>
</div>
