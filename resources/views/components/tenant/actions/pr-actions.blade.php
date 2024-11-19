<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('prs.show', $pr->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Requisition</a>
		<a class="dropdown-item" href="{{ route('prs.extra', $pr->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Extra Information</a>
		<a class="dropdown-item" href="{{ route('prs.attachments',$pr->id) }}"><i class="align-middle me-1" data-lucide="paperclip"></i> View Attachments</a>
		<a class="dropdown-item" href="{{ route('prs.history', $pr->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Approval History</a>
		<a class="dropdown-item" href="{{ route('reports.pr', $pr->id) }}" target="_blank"><i class="align-middle me-1" data-lucide="printer"></i> Print Requisition</a>

    	@can('addToPo', $pr)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('prs.add-to-po', $pr->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Add To PO</a>
		@endcan

		@can('update', $pr)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('prs.edit', $pr->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Requisition</a>
			<a class="dropdown-item" href="{{ route('prls.add-line', $pr->id) }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Add Requisition Line</a>
		@endcan

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.create') }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Requisition</a>
		<a class="dropdown-item sw2-advance" href="{{ route('prs.duplicate', $pr->id) }}"
			data-entity="" data-name="PR #{{ $pr->id }}" data-status="Duplicate"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate PR">
			<i class="align-middle me-1" data-lucide="copy"></i> Duplicate Requisition</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.index') }}"><i class="align-middle me-1" data-lucide="list"></i> All Requisitions</a>

		@can('convert', $pr)
			<a class="dropdown-item sw2-advance" href="{{ route('prs.convert', $pr->id) }}"
				data-entity="" data-name="PR#{{ $pr->id }}" data-status="Convert to PO"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Convert to PO">
				<i class="align-middle me-1" data-lucide="copy"></i> Convert to PO</a>
		@endcan

		<div class="dropdown-divider"></div>
		@can('reset', $pr)
			<a class="dropdown-item sw2-advance" href="{{ route('wfs.wf-reset-pr', $pr->id) }}"
				data-entity="" data-name="PR#{{ $pr->id }}" data-status="Reset"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Reset PR">
				<i class="align-middle me-1 text-danger" data-lucide="refresh-cw"></i> Reset Workflow**</a>
		@endcan

		<a class="dropdown-item sw2-advance" href="{{ route('prs.cancel', $pr->id) }}"
			data-entity="" data-name="PR#{{ $pr->id }}" data-status="Cancel"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Requisition">
			<i class="align-middle me-1 text-danger" data-lucide="x-circle"></i> Cancel Requisition</a>

		<a class="dropdown-item sw2-advance" href="{{ route('prs.destroy', $pr->id) }}"
			data-entity="" data-name="PR#{{ $pr->id }}" data-status="Delete"
			data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Requisition">
			<i class="align-middle me-1 text-danger" data-lucide="trash-2"></i> Delete Requisition*</a>

		@can('recalculate', App\Models\Tenant\Pr::class)
			<a class="dropdown-item sw2-advance" href="{{ route('prs.recalculate', $pr->id) }}"
				data-entity="" data-name="PR #{{ $pr->id }}" data-status="Recalculate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Recalculate">
				<i class="align-middle me-1 text-danger" data-lucide="refresh-cw"></i> Recalculate (Support)</a>
		@endcan

	</div>
</div>
