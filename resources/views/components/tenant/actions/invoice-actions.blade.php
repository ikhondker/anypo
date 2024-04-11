<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> Invoice Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		@if ($show)
		<a class="dropdown-item" href="{{ route('invoices.show', $invoice->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Invoices</a>
		@endif
		<a class="dropdown-item" href="{{ route('invoices.edit', $invoice->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Invoice</a>
		<a class="dropdown-item sw2-advance" href="{{ route('invoices.post', $invoice->id) }}"
			data-entity="" data-name="Invoice #{{ $invoice->id }}" data-status="Post"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Post Invoice">
			<i class="align-middle me-1" data-feather="copy"></i> Post Invoice *</a>
		<a class="dropdown-item" href="{{ route('invoices.create', $invoice->po_id) }}"><i class="align-middle me-1" data-feather="plus-square"></i> Create Invoice</a>
		<a class="dropdown-item" href="{{ route('payments.create',$invoice->id) }}"><i class="align-middle me-1" data-feather="layout"></i> Pay this Invoice</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('invoices.ael', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Accounting **</a>
		<a class="dropdown-item" href="{{ route('pos.show', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Purchase Order</a>
		<a class="dropdown-item" href="{{ route('reports.po', $id) }}" target="_blank"><i class="align-middle me-1" data-feather="printer"></i> Print Purchase Order</a>
		<a class="dropdown-item" href="{{ route('invoices.attachments',$id) }}"><i class="align-middle me-1" data-feather="paperclip"></i> Attachments</a>

		<div class="dropdown-divider"></div>

		<a class="dropdown-item sw2-advance" href="{{ route('invoices.cancel', $invoice->id) }}"
			data-entity="" data-name="Invoice #{{ $invoice->id }}" data-status="Cancel"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Payment">
			<i class="align-middle me-1 text-danger" data-feather="x-circle"></i> Cancel Invoice</a>
	</div>
</div>