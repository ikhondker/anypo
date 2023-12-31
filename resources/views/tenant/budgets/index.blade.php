@extends('layouts.app')
@section('title','Budget')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Budget
		@endslot
		@slot('buttons')
			<a href="{{ route('budgets.create') }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-folder-open"></i> Open Next FY Budget*</a>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-10">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Budget"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Budget Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>FY</th>
								<th>Name</th>
								<th>Start-End</th>
								<th>Currency</th>
								<th class="text-end">Amount</th>
								<th class="text-end">PR</th>
								<th class="text-end">Available (PR)</th>
								<th class="text-end">PO</th>
								<th class="text-end">Available (PO)</th>
								<th class="text-end">GRS</th>
								<th class="text-end">Payment</th>
								<th>Freeze?</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($budgets as $budget)
							<tr>
								<td>{{ $budget->fy }}</td>
								<td><a class="text-info" href="{{ route('budgets.show',$budget->id) }}">{{ $budget->name }}</a></td>
								<td><x-tenant.list.my-date :value="$budget->start_date"/> - <x-tenant.list.my-date :value="$budget->end_date"/></td>
								<td>{{ $budget->currency }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_pr_booked + $budget->amount_pr_issued"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount - $budget->amount_pr_booked - $budget->amount_pr_issued "/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_po_booked + $budget->amount_po_issued"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount - $budget->amount_po_booked - $budget->amount_po_issued"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$budget->amount_payment"/></td>
								<td><x-tenant.list.my-closed :value="$budget->freeze"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Budget" :id="$budget->id" :show="true"/>
									<a href="{{ route('budgets.destroy',$budget->id) }}" class="me-2 modal-boolean-advance" 
										data-entity="Budget" data-name="{{ $budget->name }}" data-status="{{ ($budget->freeze ? 'UnFreeze' : 'Freeze') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($budget->freeze ? 'UnFreeze' : 'freeze') }}">
										<i class="align-middle text-muted" data-feather="{{ ($budget->freeze ? 'bell-off' : 'bell') }}"></i>
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

	 @include('tenant.includes.modal-boolean-advance')    

@endsection

