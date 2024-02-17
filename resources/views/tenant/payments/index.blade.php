@extends('layouts.app')
@section('title','Payment Lists')

@section('content')

	<x-tenant.page-header>
		@slot('title')
		Payment Lists
		@endslot
		@slot('buttons')
			{{-- <x-tenant.buttons.header.create object="Payment"/> --}}
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Payment"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Payment Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Payments.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Date</th>
								<th>PO#</th>
								<th>Bank</th>
								<th>Ref/Cheque</th>
								<th>Amount</th>
								<th>Currency</th>
								<th>Paid By</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($payments as $payment)
							<tr>
								<td>{{ $payments->firstItem() + $loop->index }}</td>
								<td><x-tenant.list.my-date :value="$payment->pay_date"/></td>
								<td>{{ $payment->po_id }}</td>
								<td>{{ $payment->bank_account->ac_name }}</td>
								<td>{{ $payment->cheque_no }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$payment->amount"/></td>
								<td>{{ $payment->currency }}</td>
								<td>{{ $payment->payee->name }}</td>
								<td><span class="badge {{ $payment->status_badge->badge }}">{{ $payment->status_badge->name}}</span></td>

								<td class="table-action">
									<a href="{{ route('payments.show',$payment->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
										<i class="align-middle" data-feather="eye"></i>
									</a>
									<a href="{{ route('depts.destroy', $payment->id) }}" class="me-2 modal-boolean-advance" 
										data-entity="Payment" data-name="{{ $payment->name }}" data-status="{{ ($payment->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($payment->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($payment->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $payments->links() }}
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

