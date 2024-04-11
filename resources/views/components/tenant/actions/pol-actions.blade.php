<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> POL Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('pols.edit', $pol->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Purchase Order Line</a>
		<a class="dropdown-item" href="{{ route('pols.add-line', $pol->po_id) }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Add Purchase Order Line</a>
		<a class="dropdown-item" href="{{ route('receipts.create',$pol->id) }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Receipts</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('pols.ael', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Accounting **</a>
		<a class="dropdown-item" href="{{ route('pos.show', $pol->po_id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Purchase Order</a>
		<a class="dropdown-item" href="{{ route('reports.po', $pol->po_id) }}" target="_blank"><i class="align-middle me-1" data-feather="printer"></i> Print Purchase Order</a>
		<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Run PO Detail Report*</a>
		<a class="dropdown-item" href="{{ route('pos.attachments', $pol->po_id) }}"><i class="align-middle me-1" data-feather="paperclip"></i> Attachments</a>
		<a class="dropdown-item" href="{{ route('pos.invoice', $pol->po_id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Invoices</a>
		<div class="dropdown-divider"></div>

		<a class="dropdown-item sw2-advance" href="{{ route('pos.cancel', $id) }}"
			data-entity="" data-name="PO #{{ $id }}" data-status="Cancel"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Purchase Order">
			<i class="align-middle me-1 text-danger" data-feather="x-circle"></i> Cancel Purchase Order lINE **</a>
	</div>
</div>