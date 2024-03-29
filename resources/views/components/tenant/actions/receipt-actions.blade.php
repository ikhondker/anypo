<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Receipt Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		@if ($show)
			<a class="dropdown-item" href="{{ route('receipts.show', $receipt->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Receipt</a>
		@endif
		<a class="dropdown-item" href="{{ route('receipts.create', $receipt->pol->id) }}"><i class="align-middle me-1" data-feather="layout"></i> Create Receipt</a>
		<a class="dropdown-item" href="{{ route('pos.show', $receipt->pol_id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Purchase Order Line</a>
		<a class="dropdown-item" href="{{ route('pos.show', $receipt->pol->po_id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Purchase Order</a>

		<div class="dropdown-divider"></div>
		
		<a class="dropdown-item sweet-alert2-advance" href="{{ route('receipts.cancel', $receipt->id) }}"
			data-entity="" data-name="GRN #{{ $receipt->id }}" data-status="Cancel"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Receipt">
			<i class="align-middle me-1 text-danger" data-feather="x-circle"></i> Cancel Receipt</a>


		
	
	</div>
</div>