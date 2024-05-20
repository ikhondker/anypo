@extends('layouts.app')
@section('title','Budget')

@section('breadcrumb')
	<li class="breadcrumb-item active">Budget</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			{{ $_setup->name }} Budgets [{{ ($_setup->currency ) }}]
		@endslot
		@slot('buttons')
			<a href="{{ route('budgets.create') }}" class="btn btn-primary float-end sw2"><i data-feather="folder-plus"></i> Open Next FY Budget*</a>
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.budget-stat/>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Budget"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }} </strong>
						@else
							{{ $_setup->name }} Budgets
						@endif
					</h5>
						<h6 class="card-subtitle text-muted">List of annual Budgets.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>FY</th>
								<th class="text-end">Budget</th>

								<th class="text-end">PR (Book)</th>
								<th class="text-end">PR (Appr.)</th>
								<th class="text-end">PR (Avl.)</th>
								<th class="text-end">PO (Book)</th>
								<th class="text-end">PO (Appr.)</th>
								<th class="text-end">PO (Avl.)</th>
								<th class="text-end">GRS</th>
								<th class="text-end">Invoice</th>
								<th class="text-end">Payment</th>
								<th>Closed?</th>
								<th>Actions</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($budgets as $budget)
							<tr>
								<td><a class="text-info" href="{{ route('budgets.show',$budget->id) }}">{{ $budget->fy }}</a></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_pr_booked"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_pr"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount - $budget->amount_pr_booked - $budget->amount_pr "/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_po_booked"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount - $budget->amount_po_booked - $budget->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_invoice"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_payment"/></td>
								<td class="text-start"><x-tenant.list.my-closed :value="$budget->closed"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Budget" :id="$budget->id" :show="true"/>
									<a href="{{ route('budgets.destroy',$budget->id) }}" class="me-2 sw2-advance"
										data-entity="Budget" data-name="{{ $budget->name }}" data-status="{{ ($budget->closed ? 'Open' : 'Close') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($budget->closed ? 'Open' : 'Close') }}">
										<i class="align-middle text-muted" data-feather="{{ ($budget->closed ? 'bell-off' : 'bell') }}"></i>
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

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->




@endsection

