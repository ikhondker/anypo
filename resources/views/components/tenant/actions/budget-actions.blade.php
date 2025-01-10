<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	</a>
	<div class="dropdown-menu dropdown-menu-end">

		@if (Route::current()->getName() == 'budgets.edit')
			<a class="dropdown-item" href="{{ route('budgets.show', $budget->id) }}"><i class="align-middle me-1" data-lucide="eye"></i> View Budget</a>
		@endif
		@if (Route::current()->getName() == 'budgets.show')
			<a class="dropdown-item" href="{{ route('budgets.edit', $budget->id) }}"><i class="align-middle me-1" data-lucide="edit"></i> Edit Budget</a>
		@endif

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('budgets.attachments',$budget->id) }}"><i class="align-middle me-1" data-lucide="paperclip"></i> View Attachments</a>
		<a class="dropdown-item" href="{{ route('budgets.revisions', $budget->id) }}"><i class="align-middle me-1" data-lucide="edit-3"></i> View Revisions (*)</a>
		<a class="dropdown-item" href="{{ route('exports.budget',['revision'=>true,'parent'=>$budget->id]) }}"><i class="align-middle me-1" data-lucide="download-cloud"></i> Export Revisions (*)</a>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('budgets.index') }}"><i class="align-middle me-1" data-lucide="database"></i> View All</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item sw2-advance" href="{{ route('budgets.destroy',$budget->id) }}"
			data-entity="Budget" data-name="{{ $budget->name }}" data-status="{{ ($budget->closed ? 'Open' : 'Close') }}"
			data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($budget->closed ? 'Open' : 'Close') }}">
			<i class="align-middle me-1" data-lucide="{{ ($budget->closed ? 'unlock' : 'lock') }}"></i>
			{{ ($budget->closed ? 'Open' : 'Close') }} Budget
		</a>

		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="{{ route('budgets.timestamp', $budget->id) }}"><i class="align-middle me-1" data-lucide="calendar"></i> Timestamp</a>

	</div>
</div>
