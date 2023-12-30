@extends('layouts.landlord-app')
@section('title', 'My Invoices')
@section('breadcrumb', 'All Invoices')

@section('content')

	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">All Invoices</h5>
			<a class="btn btn-primary btn-sm" href="{{ route('invoices.create') }}">
				<i class="bi bi-plus-square me-1"></i> Generate Invoice
			</a>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>Date</th>
						<th>Type</th>
						<th>Amount</th>
						<th>Status</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($invoices as $invoice)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
											src="{{ Storage::disk('s3ll')->url($invoice->account->logo) }}" 
											alt="{{ $invoice->account->name }}" title="{{ $invoice->account->name }}">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0">#{{ Str::limit($invoice->invoice_no, 10) }}
												{{ Str::limit($invoice->summary, 20) }}</h6>
										</a>
										<small
											class="d-block">{{ date('d-M-y', strtotime($invoice->from_date)) . ' to ' . date('d-M-y', strtotime($invoice->to_date)) }}
											Account: {{ $invoice->account_id }}</small>
									</div>
								</div>
							</td>
							<td><x-landlord.list.my-date :value="$invoice->invoice_date" /></td>
							<td><x-landlord.list.my-badge :value="$invoice->invoice_type" /></td>
							<td><x-landlord.list.my-number :value="$invoice->amount" /></td>
							<td><x-landlord.list.my-badge :value="$invoice->status->name" badge="{{ $invoice->status->badge }}" /></td>
							<td>
								<a href="{{ route('invoices.show', $invoice->id) }}" class="text-body"
									data-bs-toggle="tooltip" data-bs-placement="top" title="View">
									<i class="bi bi-eye" style="font-size: 1.3rem;"></i></i>
								</a>
								<a href="{{ route('home.invoice', $invoice->invoice_no) }}" target="_blank"
									class="text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="View Online">
									<i class="bi bi-globe" style="font-size: 1.3rem;"></i></i>
								</a>
								<a href="{{ route('reports.pdf-invoice', $invoice->id) }}" class="text-body"
									data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
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
			{{ $invoices->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

@endsection

@section('bo04-content')


	<x-landlord.card.header title="Invoice Lists" />

	<div class="table-responsive bg-white shadow rounded">
		<table class="table mb-0 table-center">
			<thead>
				<tr>
					<th class="">#</th>
					<th class="">Account#</th>
					<th class="">Summary</th>
					<th class="">Date</th>
					<th class="">From</th>
					<th class="">To</th>
					<th class="">Amount</th>
					<th class="">Paid</th>
					<th class="text-center">Status</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($invoices as $invoice)
					<tr>
						<td class=""><x-landlord.list.my-id-link object="Invoice" :id="$invoice->id" /></td>
						{{-- <td class="">{{ Str::limit($invoice->service->name,15) }}</td> --}}
						<td class="">{{ $invoice->account_id }}</td>
						<td class="">{{ Str::limit($invoice->summary, 20) }}</td>
						<td class=""><x-landlord.list.my-date :value="$invoice->invoice_date" /></td>
						<td class=""><x-landlord.list.my-date :value="$invoice->from_date" /></td>
						<td class=""><x-landlord.list.my-date :value="$invoice->to_date" /></td>
						<td class="text-center"><x-landlord.list.my-number :value="$invoice->amount" /></td>
						<td class="text-center"><x-landlord.list.my-number :value="$invoice->amount_paid" /></td>
						<td class="text-center"><x-landlord.list.my-status :value="$invoice->status" /></td>
						<td class="text-center">
							<a href="{{ route('invoices.show', $invoice->id) }}" class="action-btn btn-view bs-tooltip me-2"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">
								<i data-feather="eye" class="fea text-muted"></i>
							</a>
							<a href="{{ route('home.invoice', $invoice->invoice_no) }}" target="_blank"
								class="action-btn btn-view bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top"
								title="View Online">
								<i data-feather="globe" class="fea text-muted"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</tbody>

		</table>
	</div>

	<!-- my-pagination -->
	<div class="row pt-3">
		{{ $invoices->links() }}
	</div>
	<!--/. my-pagination -->

@endsection
