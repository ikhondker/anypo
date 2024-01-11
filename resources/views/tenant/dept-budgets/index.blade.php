@extends('layouts.app')
@section('title','DeptBudget')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Department Budget [{{ ($_setup->currency ) }}]
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="DeptBudget"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-10">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="DeptBudget"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Department Budget Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Dept</th>
								<th>FY</th>
								<th>Budget Period</th>

								<th class="text-end">Budget</th>
								<th class="text-end">PR</th>
								<th class="text-end">Available (PR)</th>
								<th class="text-end">PO</th>
								<th class="text-end">Available (PO)</th>
								<th class="text-end">GRS</th>
								<th class="text-end">Payment</th>
								<th class="text-end">Freeze</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($dept_budgets as $dept_budget)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td><a class="text-info" href="{{ route('dept-budgets.show',$dept_budget->id) }}">{{ $dept_budget->dept->name  }}</a></td>
								<td>{{ $dept_budget->budget->fy }}</td>
								<td><x-tenant.list.my-date :value="$dept_budget->budget->start_date"/> - <x-tenant.list.my-date :value="$dept_budget->budget->end_date"/></td>


								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_pr_booked + $dept_budget->amount_pr_issued"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount - $dept_budget->amount_pr_booked - $dept_budget->amount_pr_issued "/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_po_booked + $dept_budget->amount_po_issued"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount - $dept_budget->amount_po_booked - $dept_budget->amount_po_issued"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$dept_budget->amount_payment"/></td>
								<td><x-tenant.list.my-closed :value="$dept_budget->freeze"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="DeptBudget" :id="$dept_budget->id"/>
									<a href="{{ route('dept-budgets.destroy',$dept_budget->id) }}" class="me-2 modal-boolean-advance"
										data-entity="DeptBudget" data-name="{{ $dept_budget->budget->name }}" data-status="{{ ($dept_budget->freeze ? 'Unfreeze' : 'Freeze') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($dept_budget->enable ? 'Unfreeze' : 'Freeze') }}">
										<i class="align-middle text-muted" data-feather="{{ ($dept_budget->freeze ? 'bell-off' : 'bell') }}"></i>
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

	 @include('tenant.includes.modal-boolean-advance')

@endsection

