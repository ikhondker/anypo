@extends('layouts.tenant.app')
@section('title','DeptBudget')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.index') }}" class="text-muted">Dept Budgets</a></li>
	<li class="breadcrumb-item active">All Revisions</li>
@endsection

@section('content')
	<x-tenant.page-header>
		@slot('title')
			All Department Budget Revision [{{ ($_setup->currency ) }}]
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>


	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="DeptBudget"/>
			<h5 class="card-title">Department Budget Revision</h5>
			<h6 class="card-subtitle text-muted">Department Budget Revision History. Amount shows values before revision.</h6>
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
                        <th>Notes</th>
						<th>Updated By</th>
						<th>Updated At</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($deptBudgets as $deptBudget)
					<tr>
						<td>{{ $deptBudgets->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('budgets.show',$deptBudget->budget_id) }}"><span class="badge rounded-pill badge-subtle-{{ $deptBudget->budget->bg_color }}">{{ $deptBudget->budget->fy }}</span></a></td>
						<td>{{ $deptBudget->budget->name }}</td>
						<td><a href="{{ route('dept-budgets.show',$deptBudget->id) }}"><span class="badge rounded-pill badge-subtle-{{ $deptBudget->dept->bg_color }}">{{ $deptBudget->dept->name }}</span></a></td>
						<td class="text-end"><x-tenant.list.my-number :value="$deptBudget->amount"/></td>
                        <td width="20%">{{ $deptBudget->notes }}</td>
						<td> {{ $deptBudget->user_created_by->name }}</td>
						<td><x-tenant.list.my-date-time :value="$deptBudget->created_at"/></td>
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

