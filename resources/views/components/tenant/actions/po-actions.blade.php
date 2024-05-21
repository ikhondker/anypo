<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> PO Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('pos.show', $po->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Purchase Order</a>
		<a class="dropdown-item" href="{{ route('pos.extra', $po->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Extra Information</a>
		<a class="dropdown-item" href="{{ route('pos.attachments',$po->id) }}"><i class="align-middle me-1" data-feather="paperclip"></i> View Attachments</a>
		<a class="dropdown-item" href="{{ route('pos.history', $po->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Approval History</a>
		<a class="dropdown-item" href="{{ route('pos.invoice', $po->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Invoices</a>
		<a class="dropdown-item" href="{{ route('pos.invoice', $po->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Payment **</a>
		<a class="dropdown-item" href="{{ route('pos.ael', $po->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Accounting **</a>
		<a class="dropdown-item" href="{{ route('reports.po', $po->id) }}" target="_blank"><i class="align-middle me-1" data-feather="printer"></i> Print Purchase Order</a>
		<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="printer"></i> Run PO Detail Report*</a>


		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('pos.edit', $po->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Purchase Order</a>
		<a class="dropdown-item" href="{{ route('pols.add-line', $po->id) }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Add Purchase Order Line</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('invoices.create', $po->id) }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Invoice</a>
		<a class="dropdown-item sw2-advance" href="{{ route('pos.copy', $po->id) }}"
			data-entity="" data-name="PO#{{ $po->id }}" data-status="Duplicate"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate PO">
			<i class="align-middle me-1 text-primary" data-feather="copy"></i> Copy Purchase Order</a>


		<div class="dropdown-divider"></div>
		<a class="dropdown-item sw2-advance" href="{{ route('pos.close', $po->id) }}"
			data-entity="" data-name="PO #{{ $po->id }}" data-status="Force Close"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Force Close">
			<i class="align-middle me-1 text-danger" data-feather="lock"></i> Force Close PO *</a>

		@can('reset', App\Models\Tenant\Wf::class)
			<a class="dropdown-item sw2-advance" href="{{ route('wfs.wf-reset-po', $po->id) }}"
				data-entity="" data-name="PO #{{ $po->id }}" data-status="Reset"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Reset PO">
				<i class="align-middle me-1 text-danger" data-feather="refresh-cw"></i> Reset Workflow**</a>
		@endcan
		<a class="dropdown-item sw2-advance" href="{{ route('pos.cancel', $po->id) }}"
			data-entity="" data-name="PO #{{ $po->id }}" data-status="Cancel"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Purchase Order">
			<i class="align-middle me-1 text-danger" data-feather="x-circle"></i> Cancel Purchase Order*</a>

		<a class="dropdown-item sw2-advance" href="{{ route('pos.destroy', $po->id) }}"
			data-entity="" data-name="PR#{{ $po->id }}" data-status="Delete"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Purchase Order">
			<i class="align-middle me-1 text-danger" data-feather="trash-2"></i> Delete Purchase Order*</a>

		@can('recalculate', App\Models\Tenant\Po::class)
			<a class="dropdown-item sw2-advance" href="{{ route('pos.recalculate', $po->id) }}"
				data-entity="" data-name="PO #{{ $po->id }}" data-status="Recalculate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Recalculate">
				<i class="align-middle me-1 text-danger" data-feather="refresh-cw"></i> Recalculate (Support)</a>
		@endcan

		@can('open', App\Models\Tenant\Po::class)
			<a class="dropdown-item sw2-advance" href="{{ route('pos.open', $po->id) }}"
				data-entity="" data-name="PR#{{ $po->id }}" data-status="Re-Open"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Re-Open">
				<i class="align-middle me-1 text-danger" data-feather="trash-2"></i> Re-Open PO (SYSTEM)</a>
		@endcan

	</div>
</div>
