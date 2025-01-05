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
            <x-tenant.card.header-search-export-bar model="Budget"/>
			<h5 class="card-title">Budgets Revisions</h5>
			<h6 class="card-subtitle text-muted">Budgets Revision History. Amount shows values before revision.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>FY</th>
						<th>Name</th>
						<th class="text-end">Amount</th>
                        <th>Notes</th>
						<th>Updated By</th>
						<th>Updated At</th>
						<th>Source</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($budgets as $budget)
					<tr>
						<td>{{ $budgets->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('budgets.show',$budget->id) }}"><span class="badge rounded-pill badge-subtle-{{ $budget->bg_color }}">{{ $budget->fy }}</span></a></td>
						<td class=""> {{ $budget->name }}</td>
						<td class="text-end"><x-tenant.list.my-number :value="$budget->amount"/></td>
                        <td width="20%">{{ $budget->notes }}</td>
						<td class=""> {{ $budget->user_created_by->name }}</td>
						<td class=""><x-tenant.list.my-date-time :value="$budget->created_at"/></td>
						<td>
							<a href="{{ route('dept-budgets.revision-detail',$budget->revision_dept_budget_id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View Source
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

