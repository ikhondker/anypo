<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">
		<a class="dropdown-item" href="{{ route('dept-budgets.edit', $id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Dept Budget</a>
		<a class="dropdown-item" href="{{ route('dept-budgets.budget', $id) }}"><i class="align-middle me-1" data-lucide="dollar-sign"></i> Budget Usage</a>
		<a class="dropdown-item sw2-advance" href="{{ route('dept-budgets.destroy',$deptBudget->id) }}" 
			data-entity="Dept Budget" data-name="{{ $deptBudget->name }}" data-status="{{ ($deptBudget->closed ? 'Open' : 'Close') }}"
			data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($deptBudget->closed ? 'Open' : 'Close') }}">
			<i class="align-middle me-1" data-lucide="{{ ($deptBudget->closed ? 'unlock' : 'lock') }}"></i>
			{{ ($deptBudget->closed ? 'Open' : 'Close') }} Dept Budget
		</a>
		<a class="dropdown-item" href="{{ route('dept-budgets.attachments',$id) }}"><i class="align-middle me-1" data-lucide="paperclip"></i> Attachments</a>
		{{-- <div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.export') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> Download Requisitions</a>
		<a class="dropdown-item" href="{{ route('prls.export') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> Download Requisition Lines</a> --}}
	</div>
</div>