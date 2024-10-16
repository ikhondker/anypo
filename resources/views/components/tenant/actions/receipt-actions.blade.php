<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('receipts.show', $receipt->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Receipt</a>
		<a class="dropdown-item" href="{{ route('receipts.show', $receipt->id) }}"><i class="align-middle me-1" data-lucide="printer"></i> Print Receipt ***</a>

		@can('createForPol', App\Models\Tenant\Receipt::class)
			<a class="dropdown-item" href="{{ route('receipts.create-for-pol', $receipt->pol->id) }}"><i class="align-middle me-1" data-lucide="layout"></i> Create Receipt</a>
		@endcan

		<a class="dropdown-item" href="{{ route('pols.show', $receipt->pol_id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Purchase Order Line</a>
		<a class="dropdown-item" href="{{ route('pos.show', $receipt->pol->po_id) }}"><i class="align-middle me-1" data-lucide="layout"></i> View Purchase Order</a>
		<a class="dropdown-item" href="{{ route('receipts.ael', $receipt->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Accounting **</a>
		<div class="dropdown-divider"></div>
		@if ($receipt->status <> App\Enum\Tenant\ReceiptStatusEnum::RECEIVED->value)
			@can('cancel', App\Models\Tenant\Receipt::class)
				<a class="dropdown-item sw2-advance" href="{{ route('receipts.cancel', $receipt->id) }}"
					data-entity="" data-name="GRN #{{ $receipt->id }}" data-status="Cancel"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Receipt">
					<i class="align-middle me-1 text-danger" data-lucide="x-circle"></i> Cancel Receipt</a>
			@endcan
		@endif
	</div>
</div>
