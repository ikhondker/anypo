@extends('layouts.tenant.app')
@section('title','Budget')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('budgets.index') }}" class="text-muted">Budgets</a></li>
	@if(!empty($budget))
		<li class="breadcrumb-item"><a href="{{ route('budgets.show',$budget->id) }}" class="text-muted">{{ $budget->name }}</a></li>
	@endif
	<li class="breadcrumb-item active">Revisions</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Budgets Revision History [{{ ($_setup->currency ) }}]
		@endslot
		@slot('buttons')
			@if(!empty($budget))
				<x-tenant.actions.budget-actions budgetId="{{ $budget->id }}"/>
			@endif
		@endslot
	</x-tenant.page-header>

	@if(!empty($budget))
		<x-tenant.dashboards.budget-stat :bid="$budget->id"/>
	@endif

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<form action="{{ route( 'budgets.revisions') }}" method="GET" role="search">
					<div class="btn-toolbar" role="toolbar" aria-label="Toolbar">
						<div class="btn-group me-2" role="group" aria-label="First group">
							<input type="text" class="form-control form-control-sm" minlength=3 name="term" placeholder="Search..." value="{{ old('term', request('term') ) }}" id="term" required>
							<div class="btn-group btn-group-lg">
								<button type="submit" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Search"><i class="align-middle" data-lucide="search"></i></button>
								<a href="{{ route( 'budgets.revisions') }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
									<i class="align-middle" data-lucide="refresh-cw"></i>
								</a>
									@if(!empty($budget))
										<a href="{{ route('exports.budget',['revision'=>true,'parent'=>$budget->id]) }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
											<i class="align-middle" data-lucide="download-cloud"></i>
										</a>
									@else
										<a href="{{ route( 'exports.budget',['revision'=>true]) }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
											<i class="align-middle" data-lucide="download-cloud"></i>
										</a>
									@endif

							</div>
						</div>
					</div>
				</form>
			</div>

			<h5 class="card-title">Budgets Revisions11</h5>
			<h6 class="card-subtitle text-muted">Budgets Revision History. Amount shows values before revision.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>FY</th>
						<th>Name</th>
						<th>Updated At</th>
						<th class="text-end">Amount</th>
						<th>Notes</th>
						<th>Updated By</th>
						<th>History</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($budgets as $budget)
					<tr>
						<td>{{ $budgets->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('budgets.show',$budget->parent_id) }}"><span class="badge rounded-pill badge-subtle-{{ $budget->bg_color }}">{{ $budget->fy }}</span></a></td>
						<td class=""> {{ $budget->name }}</td>
						<td class=""><x-tenant.list.my-date-time :value="$budget->created_at"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$budget->amount"/></td>
						<td width="20%">{{ $budget->notes }}</td>
						<td class=""> {{ $budget->user_created_by->name }}</td>
						<td>
							<a href="{{ route('dept-budgets.revision-detail',$budget->revision_dept_budget_id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View Change History
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">

				{{ $budgets->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

