@extends('layouts.app')
@section('title','Receipt Lists')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Receipt Lists
		@endslot
		@slot('buttons')
			{{-- <x-tenant.buttons.header.create object="Receipt"/> --}}
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Receipt"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Receipt Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>GRN#</th>
								<th>Date</th>
								<th>Warehouse</th>
								<th>PO#</th>
								<th>Item</th>
								<th>Qty</th>
								<th>Receiver</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($receipts as $receipt)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td><a class="text-info" href="{{ route('receipts.show',$receipt->id) }}">{{ $receipt->id }}</a></td>
								<td>{{ $receipt->receive_date }}</td>
								<td>{{ $receipt->warehouse->name }}</td>
								<td>{{ $receipt->pol->po_id }}</td>
								<td>{{ $receipt->pol->summary }}</td>
								<td>{{ $receipt->qty }}</td>
								<td>{{ $receipt->receiver->name }}</td>
								<td><x-tenant.list.my-badge :value="$receipt->status"/></td>
								<td class="table-action">
									<a href="{{ route('receipts.show',$receipt->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
										<i class="align-middle" data-feather="eye"></i></a>
									<a href="{{ route('receipts.destroy', $receipt->id) }}" class="me-2 modal-boolean-advance" 
										data-entity="Payment" data-name="{{ $receipt->id }}" data-status="{{ ($receipt->status ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($receipt->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($receipt->status ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $receipts->links() }}
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

