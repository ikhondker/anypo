<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('pols.receipt', $polId) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Receipts **</a>
		<a class="dropdown-item" href="{{ route('pos.attachments', $pol->po_id) }}"><i class="align-middle me-1" data-lucide="paperclip"></i> View Attachments **</a>
		<a class="dropdown-item" href="{{ route('pols.ael', $polId) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Accounting **</a>

		@can('createForPol', App\Models\Tenant\Receipt::class)
			<a class="dropdown-item" href="{{ route('receipts.create-for-pol',$pol->id) }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Receipts</a>
		@endcan

		@if ($pol->po->auth_status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('pols.edit', $pol->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Purchase Order Line</a>
			<a class="dropdown-item" href="{{ route('pols.add-line', $pol->po_id) }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Add Purchase Order Line</a>
		@endif

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('pos.show', $pol->po_id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Purchase Order</a>


		{{-- <a class="dropdown-item" href="{{ route('reports.po', $pol->po_id) }}" target="_blank"><i class="align-middle me-1" data-lucide="printer"></i> Print Purchase Order</a> --}}
		{{-- <a class="dropdown-item" href="#"><i class="align-middle me-1" data-lucide="user"></i> Run PO Detail Report*</a> --}}
		{{-- <a class="dropdown-item" href="{{ route('pos.invoices', $pol->po_id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Invoices</a> --}}
	</div>
</div>
