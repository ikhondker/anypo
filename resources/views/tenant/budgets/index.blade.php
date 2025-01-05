@extends('layouts.tenant.app')
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
			<a href="{{ route('budgets.create') }}" class="btn btn-primary float-end me-2 sw2"><i data-lucide="folder-plus"></i> Open Next FY Budget*</a>
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.budget-stat/>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.card.header-search-export-bar model="Budget"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-info">{{ request('term') }}</strong>
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
                                <th>Name</th>
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
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($budgets as $budget)
							<tr>
								<td><a href="{{ route('budgets.show',$budget->id) }}"><span class="badge rounded-pill badge-subtle-{{ $budget->bg_color }}">{{ $budget->fy }}</span></a></td>
                                <td>{{ $budget->name }}</td>
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
								<td><x-tenant.list.my-closed :value="$budget->closed"/></td>
								<td>
									<a href="{{ route('budgets.show',$budget->id) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
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

