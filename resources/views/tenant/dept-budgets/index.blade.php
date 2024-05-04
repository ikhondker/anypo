@extends('layouts.app')
@section('title','DeptBudget')

@section('breadcrumb')
	<li class="breadcrumb-item active">Dept. Budget</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Department Budget [{{ ($_setup->currency ) }}]
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="DeptBudget"/>
		@endslot
	</x-tenant.page-header>

	@if ( \App\Helpers\Akk::userAnyDeptBudgetExists() )
		<x-tenant.dashboards.dept-budget-stat/>
	@endif 	


	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="DeptBudget"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Departments Annual Budgets
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of annual Departmental Budgets.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>FY</th>
								<th>Dept</th>
								<th>Budget Period</th>

								<th class="text-end">Budget</th>
								<th class="text-end">PR (Booked)</th>
								<th class="text-end">PR (Approved)</th>
								<th class="text-end">PR (Available)</th>
								<th class="text-end">PO (Booked)</th>
								<th class="text-end">PO (Approved)</th>
								<th class="text-end">PO <br>(Available)</th>
								<th class="text-end">GRS</th>
								<th class="text-end">Invoice</th>
								<th class="text-end">Payment</th>
								
								<th class="text-end">Closed</th>
								<th>Actions</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($dept_budgets as $dept_budget)
							<tr>
								<td>{{ $dept_budgets->firstItem() + $loop->index }}</td>
								<td>{{ $dept_budget->budget->fy }}</td>
								<td><a class="text-info" href="{{ route('dept-budgets.show',$dept_budget->id) }}">{{ $dept_budget->dept->name }}</a></td>
								<td><x-tenant.list.my-date :value="$dept_budget->budget->start_date"/> - <x-tenant.list.my-date :value="$dept_budget->budget->end_date"/></td>

								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_pr_booked"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_pr"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount - $dept_budget->amount_pr_booked - $dept_budget->amount_pr "/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_po_booked"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount - $dept_budget->amount_po_booked - $dept_budget->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_invoice"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_payment"/></td>
								<td><x-tenant.list.my-closed :value="$dept_budget->closed"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="DeptBudget" :id="$dept_budget->id"/>
									<a href="{{ route('dept-budgets.destroy',$dept_budget->id) }}" class="me-2 sw2-advance"
										data-entity="DeptBudget" data-name="{{ $dept_budget->budget->name }}" data-status="{{ ($dept_budget->closed ? 'Open' : 'Close') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($dept_budget->closed ? 'Open' : 'Close') }}">
										<i class="align-middle text-muted" data-feather="{{ ($dept_budget->closed ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $dept_budgets->links() }}
					</div>
					<!-- end pagination -->

				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

	 @include('shared.includes.js.sw2-advance')

@endsection

