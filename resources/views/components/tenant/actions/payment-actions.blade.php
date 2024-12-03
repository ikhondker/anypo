<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('payments.show', $payment->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Payment</a>
		<a class="dropdown-item" href="{{ route('payments.ael', $paymentId) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Accounting **</a>
		<a class="dropdown-item" href="{{ route('invoices.show',$payment->invoice_id) }}"><i class="align-middle me-1" data-lucide="layout"></i> View Invoice</a>
		<a class="dropdown-item" href="{{ route('pos.show', $payment->invoice->po_id) }}"><i class="align-middle me-1" data-lucide="layout"></i> View Purchase Order</a>

		@can('createForInvoice', App\Models\Tenant\Payment::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('payments.create-for-invoice', $payment->invoice_id) }}"><i class="align-middle me-1" data-lucide="plus-square"></i> Make Another Payment</a>
		@endcan

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('payments.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All </a>

		@can('cancel', App\Models\Tenant\Invoice::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item sw2-advance" href="{{ route('payments.cancel', $payment->id) }}"
				data-entity="" data-name="PO #{{ $payment->id }}" data-status="Cancel"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Payment">
				<i class="align-middle me-1 text-danger" data-lucide="x-circle"></i> Cancel Payment *</a>
		@endcan

         <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('payments.timestamp', $payment->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>

	</div>
</div>
