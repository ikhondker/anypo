@extends('layouts.app')
@section('title','Invoice Lists')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Invoice Lists
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Invoice"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Invoice"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Invoice Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>

								<th>#</th>
								<th>Date</th>
								<th>PO#</th>
								<th>INV NO#</th>
								<th>Summary</th>
								<th>Currency</th>
								<th>Amount</th>
								<th>Paid</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($invoices as $invoice)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td><x-tenant.list.my-date :value="$invoice->inv_date"/></td>
								<td>{{ $invoice->po_id }}</td>
								<td>{{ $invoice->invoice_no }}</td>
								<td>{{ $invoice->summary }}</td>
								<td>{{ $invoice->currency }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$invoice->amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$invoice->paid_amount"/></td>
								<td><x-tenant.list.my-badge :value="$invoice->status"/></td>
								<td class="table-action">
									<a href="{{ route('invoices.show',$invoice->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
										<i class="align-middle" data-feather="eye"></i>
									</a>
									<a href="{{ route('depts.destroy', $invoice->id) }}" class="me-2 modal-boolean-advance" 
										data-entity="Invoice" data-name="{{ $invoice->name }}" data-status="{{ ($invoice->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($invoice->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($invoice->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $invoices->links() }}
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

