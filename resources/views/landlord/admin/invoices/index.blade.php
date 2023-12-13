@extends('layouts.landlord-app')
@section('title', 'My Invoices')
@section('breadcrumb', 'My Invoices')

@section('content')

	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">Your Invoices</h5>
			{{-- @if ($invoice->status_code->value == App\Enum\LandlordInvoiceStatusEnum::DUE->value)  --}}
			<a class="btn btn-primary btn-sm" href="{{ route('invoices.create') }}">
				<i class="bi bi-plus-square me-1"></i> Generate Invoice
			</a>
			{{-- @endif --}}
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
											src="{{ url($_logo_dir. $invoice->account->logo) }}"
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
								{{-- <a href="{{ route('invoices.show', $invoice->id) }}" class="text-body"
									data-bs-toggle="tooltip" data-bs-placement="top" title="View">
									<i class="bi bi-eye" style="font-size: 1.3rem;"></i>
								</a> --}}
								<a href="{{ route('home.invoice', $invoice->invoice_no) }}" target="_blank"
									class="text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="View Online">
									<i class="bi bi-eye" style="font-size: 1.3rem;"></i>
								</a>
								<a href="{{ route('reports.pdf-invoice', $invoice->id) }}" class="text-body"
									data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
									<i class="bi bi-cloud-download" style="font-size: 1.3rem;"></i>
								</a>
								{{-- <a href="{{ route('invoices.pdf', $invoice->id) }}" class="text-body"
									data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
									<i class="bi bi-cloud-download" style="font-size: 1.3rem;"></i>inv
								</a> --}}
								
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
