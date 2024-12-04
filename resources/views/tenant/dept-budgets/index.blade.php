@extends('layouts.tenant.app')
@section('title','DeptBudget')

@section('breadcrumb')
	<li class="breadcrumb-item active">Dept Budget</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Department Budget [{{ ($_setup->currency ) }}]
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="DeptBudget"/>
		@endslot
	</x-tenant.page-header>

	@if ( \App\Helpers\Tenant\Akk::userAnyDeptBudgetExists() )
		<x-tenant.dashboards.dept-budget-stat/>
	@endif


	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.card.header-search-export-bar model="DeptBudget"/>
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
								<th class="text-end">Budget</th>
								<th class="text-end">PR (Used)</th>
								<th class="text-end">PR (Avl.)</th>
								<th class="text-end">PO (Used)</th>
								<th class="text-end">PO (Avl.)</th>
								<th class="text-end">Receipt</th>
								<th class="text-end">Invoice</th>
								<th class="text-end">Payment</th>
								<th>Closed?</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($dept_budgets as $dept_budget)
							<tr>
								<td>{{ $dept_budgets->firstItem() + $loop->index }}</td>
								<td>{{ $dept_budget->budget->fy }}</td>
								<td><a href="{{ route('dept-budgets.show',$dept_budget->id) }}"><strong>{{ $dept_budget->dept->name }}</a></strong></td>

								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_pr_booked + $dept_budget->amount_pr"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount - $dept_budget->amount_pr_booked - $dept_budget->amount_pr "/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_po_booked + $dept_budget->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount - $dept_budget->amount_po_booked - $dept_budget->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_invoice"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_payment"/></td>
								<td><x-tenant.list.my-closed :value="$dept_budget->closed"/></td>
								<td>
									<a href="{{ route('dept-budgets.show',$dept_budget->id) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
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



@endsection

