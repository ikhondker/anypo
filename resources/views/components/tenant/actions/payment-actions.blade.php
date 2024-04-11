<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Payment Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		@if ($show)
			<a class="dropdown-item" href="{{ route('payments.show', $payment->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Payment</a>
		@endif
		<a class="dropdown-item" href="{{ route('payments.create', $payment->invoice_id) }}"><i class="align-middle me-1" data-feather="plus-square"></i> Make Another Payment</a>
		<a class="dropdown-item" href="{{ route('invoices.show',$payment->invoice_id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Invoice</a>
		<a class="dropdown-item" href="{{ route('pos.show', $payment->invoice->po_id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Purchase Order</a>
		<a class="dropdown-item" href="{{ route('payments.ael', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Accounting **</a>
		<div class="dropdown-divider"></div>

		<a class="dropdown-item sw2-advance" href="{{ route('payments.cancel', $payment->id) }}"
			data-entity="" data-name="PO #{{ $payment->id }}" data-status="Cancel"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Payment">
			<i class="align-middle me-1 text-danger" data-feather="x-circle"></i> Cancel Payment *</a>
	
	</div>
</div>