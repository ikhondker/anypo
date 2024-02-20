<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-feather="folder"></i> PR Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		
		@if ($show)
			<a class="dropdown-item" href="{{ route('prs.show', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Requisition</a>
		@endif
		<a class="dropdown-item" href="{{ route('reports.pr', $id) }}" target="_blank"><i class="align-middle me-1" data-feather="printer"></i> Print Requisition</a>
		<a class="dropdown-item" href="{{ route('prs.edit', $id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Requisition</a>
		<a class="dropdown-item" href="{{ route('prls.createline', $id) }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Add Requisition Line</a>
		<a class="dropdown-item" href="{{ route('prs.history', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Approval History</a>
		<a class="dropdown-item" href="{{ route('prs.extra', $id) }}"><i class="align-middle me-1" data-feather="eye"></i> Additional Information</a>
		<a class="dropdown-item" href="{{ route('prs.detach',$id) }}"><i class="align-middle me-1" data-feather="paperclip"></i> Attachments</a>
		<a class="dropdown-item modal-boolean-advance"  href="{{ route('prs.copy', $id) }}"
			data-entity="" data-name="PR #{{ $id }}" data-status="Duplicate"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate PR">
			<i class="align-middle me-1" data-feather="copy"></i> Copy Requisition</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item modal-boolean-advance"  href="{{ route('prs.convert', $id) }}"
			data-entity="" data-name="PR#{{ $id }}" data-status="Covert to PO"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Covert to PO">
			<i class="align-middle me-1 text-primary" data-feather="copy"></i> Covert to PO</a>
		
		<div class="dropdown-divider"></div>

		<a class="dropdown-item modal-boolean-advance"  href="{{ route('wfs.wf-reset-pr', $id) }}"
			data-entity="" data-name="PR#{{ $id }}" data-status="Reset"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Reset PR"> 
			<i class="align-middle me-1  text-danger" data-feather="refresh-cw"></i> Reset Workflow**</a>

		<a class="dropdown-item modal-boolean-advance"  href="{{ route('prs.cancel', $id) }}"
			data-entity="" data-name="PR#{{ $id }}" data-status="Cancel"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Requisition">
			<i class="align-middle me-1 text-danger" data-feather="x-circle"></i> Cancel Requisition</a>

		<a class="dropdown-item modal-boolean-advance"  href="{{ route('prs.destroy', $id) }}"
			data-entity="" data-name="PR#{{ $id }}" data-status="Delete"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Requisition">
			<i class="align-middle me-1 text-danger" data-feather="trash-2"></i> Delete Requisition*</a>

	</div>
</div>