<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'dept-budgets.edit')
			<a class="dropdown-item" href="{{ route('dept-budgets.show', $deptBudgetId) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Budget</a>
		@endif
		@if (Route::current()->getName() == 'dept-budgets.show')
			<a class="dropdown-item" href="{{ route('dept-budgets.edit', $deptBudgetId) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Dept Budget</a>
		@endif
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('dept-budgets.dbu', $deptBudgetId) }}"><i class="align-middle me-1" data-lucide="dollar-sign"></i> View Budget Usage</a>
		<a class="dropdown-item" href="{{ route('dept-budgets.attachments',$deptBudgetId) }}"><i class="align-middle me-1" data-lucide="paperclip"></i> View Attachments</a>
		<a class="dropdown-item" href="{{ route('dept-budgets.revisions', $deptBudgetId) }}"><i class="align-middle me-1" data-lucide="edit-3"></i> View Revisions (*)</a>
		
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('dept-budgets.index') }}"><i class="align-middle me-1" data-lucide="list"></i> View All</a>
		
		@can('create', App\Models\Tenant\DeptBudget::class)
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="{{ route('dept-budgets.create') }}"><i class="align-middle me-1" data-lucide="plus-circle"></i> Create Dept Budget</a>
		@endcan

		<div class="dropdown-divider"></div>
		<a class="dropdown-item sw2-advance" href="{{ route('dept-budgets.destroy',$deptBudget->id) }}" 
			data-entity="Dept Budget" data-name="{{ $deptBudget->budget->name }}" data-status="{{ ($deptBudget->closed ? 'Open' : 'Close') }}"
			data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($deptBudget->closed ? 'Open' : 'Close') }}">
			<i class="align-middle me-1" data-lucide="{{ ($deptBudget->closed ? 'unlock' : 'lock') }}"></i>
			{{ ($deptBudget->closed ? 'Open' : 'Close') }} Dept Budget
		</a>

		

		{{-- <div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('prs.export') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> Download Requisitions</a>
		<a class="dropdown-item" href="{{ route('prls.export') }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> Download Requisition Lines</a> --}}



	</div>
</div>