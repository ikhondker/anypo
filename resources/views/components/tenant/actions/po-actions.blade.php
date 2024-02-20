<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> PO Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">
		@if ($show)
			<a class="dropdown-item" href="{{ route('pos.show', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Purchase Order</a>
		@endif
		<a class="dropdown-item" href="{{ route('reports.po', $id) }}" target="_blank"><i class="align-middle me-1" data-feather="printer"></i> Print Purchase Order</a>
		<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Run PO Detail Report*</a>
		<a class="dropdown-item" href="{{ route('pos.edit', $id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Purchase Order</a>
		<a class="dropdown-item" href="{{ route('pols.createline', $id) }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Add Purchase Order Line</a>
		
		<a class="dropdown-item" href="{{ route('pos.history', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Approval History</a>
		<a class="dropdown-item" href="{{ route('pos.extra', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> Additional Information</a>
		<a class="dropdown-item" href="{{ route('pos.detach',$id) }}"><i class="align-middle me-1" data-feather="paperclip"></i> Attachments</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('pos.invoice', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Invoices</a>
		<a class="dropdown-item" href="{{ route('invoices.create', $id) }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Invoice</a>

		<div class="dropdown-divider"></div>

		<a class="dropdown-item modal-boolean-advance"  href="{{ route('pos.copy', $id) }}"
			data-entity="" data-name="PO#{{ $id }}" data-status="Duplicate"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate PO">
			<i class="align-middle me-1 text-primary" data-feather="copy"></i> Copy Purchase Order</a>
		

		<div class="dropdown-divider"></div>

		<a class="dropdown-item modal-boolean-advance"  href="{{ route('pos.close', $id) }}"
			data-entity="" data-name="PO #{{ $id }}" data-status="Force Close"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Force Close">
			<i class="align-middle me-1 text-danger" data-feather="x"></i> Force Close PO *</a>

		<a class="dropdown-item modal-boolean-advance"  href="{{ route('wfs.wf-reset-po', $id) }}"
			data-entity="" data-name="PO #{{ $id }}" data-status="Reset"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Reset PO"> 
			<i class="align-middle me-1 text-danger" data-feather="refresh-cw"></i> Reset Workflow**</a>

		<a class="dropdown-item modal-boolean-advance"  href="{{ route('pos.cancel', $id) }}"
			data-entity="" data-name="PO #{{ $id }}" data-status="Cancel"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Purchase Order">
			<i class="align-middle me-1 text-danger" data-feather="x-circle"></i> Cancel Purchase Order</a>

		<a class="dropdown-item modal-boolean-advance"  href="{{ route('pos.destroy', $id) }}"
			data-entity="" data-name="PR#{{ $id }}" data-status="Delete"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Purchase Order">
			<i class="align-middle me-1 text-danger" data-feather="trash-2"></i> Delete Purchase Order*</a>

		@if (  auth()->user()->role->value == UserRoleEnum::SYSTEM->value)
			<a class="dropdown-item modal-boolean-advance"  href="{{ route('pos.open', $id) }}"
				data-entity="" data-name="PR#{{ $id }}" data-status="Re-Open"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Re-Open">
				<i class="align-middle me-1 text-danger" data-feather="trash-2"></i> Re-Open PO (SYSTEM)</a>
		@endif

	</div>
</div>