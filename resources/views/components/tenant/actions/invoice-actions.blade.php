<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('invoices.show', $invoice->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Invoices</a>
		<a class="dropdown-item" href="{{ route('invoices.payments', $invoice->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Payments</a>
		<a class="dropdown-item" href="{{ route('invoices.ael', $invoiceId) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Accounting **</a>

		<a class="dropdown-item" href="{{ route('invoices.attachments',$invoiceId) }}"><i class="align-middle me-1" data-lucide="paperclip"></i> Attachments</a>

		<div class="dropdown-divider"></div>
		@can('update', $invoice)
			<a class="dropdown-item" href="{{ route('invoices.edit', $invoice->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Invoice</a>
		@endcan

		{{-- @if ($invoice->status <> App\Enum\Tenant\InvoiceStatusEnum::POSTED->value) --}}
			@can('post', $invoice)
				<a class="dropdown-item sw2-advance" href="{{ route('invoices.post', $invoice->id) }}"
					data-entity="" data-name="Invoice #{{ $invoice->id }}" data-status="Post"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Post Invoice">
					<i class="align-middle me-1" data-lucide="copy"></i> Post Invoice *</a>
			@endcan
		{{-- @endif --}}

		@can('createForInvoice', App\Models\Tenant\Payment::class)
			<a class="dropdown-item" href="{{ route('payments.create-for-invoice',$invoice->id) }}"><i class="align-middle me-1" data-lucide="layout"></i> Pay Invoice</a>
		@endcan

		@can('createForPo', App\Models\Tenant\Invoice::class)
			<a class="dropdown-item" href="{{ route('invoices.create-for-po', $invoice->po_id) }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Invoice</a>
		@endcan


		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('invoices.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All </a>
		<a class="dropdown-item" href="{{ route('pos.show', $invoice->po_id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Purchase Order</a>
		<a class="dropdown-item" href="{{ route('reports.po', $invoice->po_id) }}" target="_blank"><i class="align-middle me-1" data-lucide="printer"></i> Print Invoice **</a>

		@can('cancel', App\Models\Tenant\Invoice::class)
			<div class="dropdown-divider"></div>
				<a class="dropdown-item sw2-advance" href="{{ route('invoices.cancel', $invoice->id) }}"
					data-entity="" data-name="Invoice #{{ $invoice->id }}" data-status="Cancel"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Payment">
					<i class="align-middle me-1 text-danger" data-lucide="x-circle"></i> Cancel Invoice</a>
		@endcan

		@can('recalculate', App\Models\Tenant\Invoice::class)
			<a class="dropdown-item sw2-advance" href="{{ route('invoices.recalculate', $invoice->id) }}"
				data-entity="" data-name="Invoice #{{ $invoice->id }}" data-status="Recalculate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Recalculate">
				<i class="align-middle me-1 text-danger" data-lucide="refresh-cw"></i> Recalculate (Support)</a>
		@endcan
	</div>
</div>
