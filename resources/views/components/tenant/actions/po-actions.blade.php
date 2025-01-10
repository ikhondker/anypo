<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		<a class="dropdown-item" href="{{ route('pos.show', $po->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Purchase Order</a>
		<a class="dropdown-item" href="{{ route('pos.extra', $po->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Extra Information</a>
		<a class="dropdown-item" href="{{ route('pos.attachments',$po->id) }}"><i class="align-middle me-1" data-lucide="paperclip"></i> View Attachments</a>
		<a class="dropdown-item" href="{{ route('pos.history', $po->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Approval History</a>


		@can('update', $po)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('pos.edit', $po->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Purchase Order</a>
			<a class="dropdown-item" href="{{ route('pols.add-line', $po->id) }}"><i class="align-middle me-1" data-lucide="plus"></i> Add Purchase Order Line</a>
		@endcan


		@if ( $po->auth_status == App\Enum\Tenant\AuthStatusEnum::APPROVED->value )
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('pos.invoices', $po->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Invoices</a>
		@endif

		@if ( ($po->auth_status == App\Enum\Tenant\AuthStatusEnum::APPROVED->value) && ($po->status == App\Enum\Tenant\ClosureStatusEnum::OPEN->value) )
			@can('createForPo', App\Models\Tenant\Invoice::class)
				<a class="dropdown-item" href="{{ route('invoices.create-for-po', $po->id) }}"><i class="align-middle me-1" data-lucide="plus"></i> Create Invoice</a>
			@endcan
		@endif

		@if ( $po->auth_status == App\Enum\Tenant\AuthStatusEnum::APPROVED->value )
		<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('pos.payments', $po->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Payments</a>
			<a class="dropdown-item" href="{{ route('pos.ael', $po->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View All Accounting **</a>
		@endif

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('reports.po', $po->id) }}" target="_blank"><i class="align-middle me-1" data-lucide="printer"></i> Print Purchase Order</a>
		<a class="dropdown-item" href="#"><i class="align-middle me-1" data-lucide="printer"></i> Print PO Detail Report*</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('pos.index') }}"><i class="align-middle me-1" data-lucide="database"></i> View All </a>
		@can('duplicate', App\Models\Tenant\Po::class)
			<a class="dropdown-item sw2-advance" href="{{ route('pos.duplicate', $po->id) }}"
				data-entity="" data-name="PO#{{ $po->id }}" data-status="Duplicate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate PO">
				<i class="align-middle me-1" data-lucide="copy"></i> Duplicate Purchase Order</a>
		@endcan

		@can('close', $po)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item sw2-advance" href="{{ route('pos.close', $po->id) }}"
				data-entity="" data-name="PO #{{ $po->id }}" data-status="Force Close"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Force Close">
				<i class="align-middle me-1 text-danger" data-lucide="lock"></i> Force Close PO **</a>
		@endcan

		@can('open', $po)
			<a class="dropdown-item sw2-advance" href="{{ route('pos.open', $po->id) }}"
				data-entity="" data-name="PO #{{ $po->id }}" data-status="Open"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Open">
				<i class="align-middle me-1 text-danger" data-lucide="lock"></i> Open PO *</a>
		@endcan

		@can('reset', $po)
			<a class="dropdown-item sw2-advance" href="{{ route('wfs.wf-reset-po', $po->id) }}"
				data-entity="" data-name="PO #{{ $po->id }}" data-status="Reset"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Reset PO">
				<i class="align-middle me-1 text-danger" data-lucide="refresh-cw"></i> Reset Workflow**</a>
		@endcan

		@can('cancel', $po)
			<a class="dropdown-item sw2-advance" href="{{ route('pos.cancel', $po->id) }}"
				data-entity="" data-name="PO #{{ $po->id }}" data-status="Cancel"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Purchase Order">
				<i class="align-middle me-1 text-danger" data-lucide="x-circle"></i> Cancel Purchase Order*</a>
		@endcan

		@can('delete', $po)
			<a class="dropdown-item sw2-advance" href="{{ route('pos.destroy', $po->id) }}"
				data-entity="" data-name="PR#{{ $po->id }}" data-status="Delete"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Purchase Order">
				<i class="align-middle me-1 text-danger" data-lucide="trash-2"></i> Delete Purchase Order*</a>
		@endcan

		@can('recalculate', $po)
			<a class="dropdown-item sw2-advance" href="{{ route('pos.recalculate', $po->id) }}"
				data-entity="" data-name="PO #{{ $po->id }}" data-status="Recalculate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Recalculate">
				<i class="align-middle me-1 text-danger" data-lucide="refresh-cw"></i> Recalculate (Support)</a>
		@endcan

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('pos.timestamp', $po->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>

	</div>
</div>
