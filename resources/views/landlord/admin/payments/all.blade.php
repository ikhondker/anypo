@extends('layouts.landlord-app')
@section('title', 'Payments')
@section('breadcrumb', 'All Payments')

@section('content')
	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-title">All Payments</h5>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>Date</th>
						<th>Invoice #</th>
						<th>Amount</th>
						<th>Status</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($payments as $payment)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
											src="{{ Storage::disk('s3ll')->url($payment->account->logo) }}" 
											alt="{{ $payment->account->name }}" title="{{ $payment->account->name }}">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0">{{ Str::limit($payment->summary, 15) }}</h6>
										</a>
										<small class="d-block">ID: {{ $payment->id }}</small>
									</div>
								</div>
							</td>
							<td><x-landlord.list.my-date :value="$payment->pay_date" /></td>
							<td>{{ $payment->invoice_id }}</td>
							<td><x-landlord.list.my-number :value="$payment->amount" /></td>
							<td><x-landlord.list.my-badge :value="$payment->status->name" badge="{{ $payment->status->badge }}" /></td>
							<td><x-landlord.list.actions object="Payment" :id="$payment->id" :export="false"
									:enable="false" />
								<a href="{{ route('reports.pdf-payment', $payment->id) }}" class="text-body"
									data-bs-toggle="tooltip" data-bs-placement="top" title="Receipt">
									<i class="bi bi-cloud-download" style="font-size: 1.3rem;"></i>
								</a>

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- End Table -->

		<!-- card-body -->
		<div class="card-body">
			<!-- pagination -->
			{{ $payments->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->
@endsection



@section('bo04-content')

	<x-landlord.card.header title="My Payments" />

	<div class="table-responsive bg-white shadow rounded">
		<table class="table mb-0 table-center">
			<thead>
				<tr>
					<th class="" scope="col">#</th>
					<th class="" scope="col">Date</th>
					<th class="" scope="col">Summary</th>
					<th class="" scope="col">Invoice</th>
					<th class="" scope="col">Cheque No</th>
					<th class="" scope="col">Amount</th>
					<th class="" scope="col">Status</th>
					<th class="text-center" scope="col">Action</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($payments as $payment)
					<tr>
						<td class=""><x-landlord.list.my-id-link object="Payment" :id="$payment->id" /></td>
						<td class=""><x-landlord.list.my-date :value="$payment->pay_date" /></td>
						<td class="">{{ Str::limit($payment->summary, 15) }}</td>
						<td class="">{{ $payment->invoice_id }}</td>
						<td class="">{{ $payment->cheque_no }}</td>
						<td class="text-end"><x-landlord.list.my-number :value="$payment->amount" /></td>
						<td class="text-center"><x-landlord.list.my-badge :value="$payment->status" /></td>
						<td class="text-center">
							<a href="{{ route('payments.show', $payment->id) }}" class="action-btn btn-view bs-tooltip me-2"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">
								<i data-feather="eye" class="fea text-muted"></i>
							</a>
					</tr>
				@endforeach
			</tbody>

		</table>
	</div>

	<!-- my-pagination -->
	<div class="row pt-3">
		{{ $payments->links() }}
	</div>
	<!--/. my-pagination -->
@endsection


