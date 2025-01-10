@extends('layouts.tenant.app')
@section('title','DeptBudget')

@section('breadcrumb')

	@if(!empty($deptBudget))
		<li class="breadcrumb-item"><a href="{{ route('budgets.show', $deptBudget->budget->id ) }}" class="text-muted">{{ $deptBudget->budget->fy }}</a></li>
	@endif
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.index') }}" class="text-muted">Dept Budgets</a></li>
	@if(!empty($deptBudget))
		<li class="breadcrumb-item"><a href="{{ route('dept-budgets.show',$deptBudget->id) }}" class="text-muted">{{ $deptBudget->dept->name }}</a></li>
	@endif
	<li class="breadcrumb-item active">Revisions</li>
@endsection

@section('content')
	<x-tenant.page-header>
		@slot('title')
			Department Budget Revision [{{ ($_setup->currency ) }}]
		@endslot
		@slot('buttons')
			@if(!empty($deptBudget))
				<x-tenant.actions.dept-budget-actions deptBudgetId="{{ $deptBudget->id }}"/>
			@endif
		@endslot
	</x-tenant.page-header>

	@if(!empty($deptBudget))
		<x-tenant.dashboards.dept-budget-stat :dbid="$deptBudget->id"/>
	@endif

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<form action="{{ route( 'dept-budgets.revisions') }}" method="GET" role="search">
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar">
						<div class="btn-group me-2" role="group" aria-label="First group">
							<input type="text" class="form-control form-control-sm" minlength=3 name="term" placeholder="Search..." value="{{ old('term', request('term') ) }}" id="term" required>
							<div class="btn-group btn-group-lg">
								<button type="submit" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Search"><i class="align-middle" data-lucide="search"></i></button>
								<a href="{{ route( 'dept-budgets.revisions') }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
									<i class="align-middle" data-lucide="refresh-cw"></i>
								</a>
								@if(!empty($deptBudget))
										<a href="{{ route('exports.dept-budget',['revision'=>true,'parent'=>$deptBudget->id]) }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
											<i class="align-middle" data-lucide="download-cloud"></i>
										</a>
									@else
										<a href="{{ route( 'exports.dept-budget',['revision' => true]) }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
											<i class="align-middle" data-lucide="download-cloud"></i>
										</a>
									@endif
							</div>
						</div>
					</div>
				</form>
			</div>

			<h5 class="card-title">Department Budget Revision</h5>
			<h6 class="card-subtitle text-muted">Department Budget Revision History.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>FY</th>
						<th>Name</th>
						<th>Dept</th>
						<th class="text-end">Amount</th>
						<th>Updated By</th>
						<th>Updated At</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($deptBudgets as $deptBudget)
					<tr>
						<td>{{ $deptBudgets->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('budgets.show',$deptBudget->budget_id) }}"><strong>{{ $deptBudget->budget->fy }}</strong></a></td>
						<td>{{ $deptBudget->budget->name }}</td>
						<td><a href="{{ route('dept-budgets.show',$deptBudget->id) }}"><strong>{{ $deptBudget->dept->name }}</a></strong></td>

						<td class="text-end"><x-tenant.list.my-number :value="$deptBudget->amount"/></td>
						<td class=""> {{ $deptBudget->user_created_by->name }}</td>
						<td class=""><x-tenant.list.my-date-time :value="$deptBudget->created_at"/></td>
						<td>
							<a href="{{ route('dept-budgets.revision-detail',$deptBudget->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $deptBudgets->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

