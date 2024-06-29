<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle mt-n1" data-lucide="settings"></i> PR Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('prs.show', $pr->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Requisition</a>
		<a class="dropdown-item" href="{{ route('prs.extra', $pr->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Extra Information</a>
		<a class="dropdown-item" href="{{ route('prs.attachments',$pr->id) }}"><i class="align-middle me-1" data-feather="paperclip"></i> View Attachments</a>
		<a class="dropdown-item" href="{{ route('prs.history', $pr->id) }}"><i class="align-middle me-1" data-feather="eye"></i> View Approval History</a>
		<a class="dropdown-item" href="{{ route('reports.pr', $pr->id) }}" target="_blank"><i class="align-middle me-1" data-feather="printer"></i> Print Requisition</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.edit', $pr->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Requisition</a>
		<a class="dropdown-item" href="{{ route('prls.add-line', $pr->id) }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Add Requisition Line</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.create') }}"><i class="align-middle me-1" data-feather="plus-circle"></i> Create Requisition</a>
		<a class="dropdown-item sw2-advance" href="{{ route('prs.copy', $pr->id) }}"
			data-entity="" data-name="PR #{{ $pr->id }}" data-status="Duplicate"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate PR">
			<i class="align-middle me-1" data-feather="copy"></i> Copy Requisition</a>

		@can('convert', $pr)
			<a class="dropdown-item sw2-advance" href="{{ route('prs.convert', $pr->id) }}"
				data-entity="" data-name="PR#{{ $pr->id }}" data-status="Convert to PO"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Convert to PO">
				<i class="align-middle me-1" data-feather="copy"></i> Convert to PO</a>
			@endcan
		<div class="dropdown-divider"></div>
		@can('reset', App\Models\Tenant\Wf::class)
			<a class="dropdown-item sw2-advance" href="{{ route('wfs.wf-reset-pr', $pr->id) }}"
				data-entity="" data-name="PR#{{ $pr->id }}" data-status="Reset"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Reset PR">
				<i class="align-middle me-1 text-danger" data-feather="refresh-cw"></i> Reset Workflow**</a>
		@endcan

		<a class="dropdown-item sw2-advance" href="{{ route('prs.cancel', $pr->id) }}"
			data-entity="" data-name="PR#{{ $pr->id }}" data-status="Cancel"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Requisition">
			<i class="align-middle me-1 text-danger" data-feather="x-circle"></i> Cancel Requisition</a>

		<a class="dropdown-item sw2-advance" href="{{ route('prs.destroy', $pr->id) }}"
			data-entity="" data-name="PR#{{ $pr->id }}" data-status="Delete"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Requisition">
			<i class="align-middle me-1 text-danger" data-feather="trash-2"></i> Delete Requisition*</a>

		@can('recalculate', App\Models\Tenant\Pr::class)
			<a class="dropdown-item sw2-advance" href="{{ route('prs.recalculate', $pr->id) }}"
				data-entity="" data-name="PR #{{ $pr->id }}" data-status="Recalculate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Recalculate">
				<i class="align-middle me-1 text-danger" data-feather="refresh-cw"></i> Recalculate (Support)</a>
		@endcan

	</div>
</div>
