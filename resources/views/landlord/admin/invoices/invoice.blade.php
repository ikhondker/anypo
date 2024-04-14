@extends('layouts.landlord-blank')
@section('title', 'View Invoice')
@section('breadcrumb', 'View Invoice')


@section('content')
	<div class="container content-space-2">
		<div class="w-lg-85 mx-lg-auto">
			<!-- Card -->
			<div class="card card-lg mb-5">
				<div class="card-body">
					<div class="row justify-content-lg-between">
						<div class="col-sm order-2 order-sm-1 mb-3">
							<div class="mb-2">
								<img class="avatar-xl" src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Logo">
							</div>

							{{-- <h1 class="h2 text-primary">{{ $config->name }}</h1> --}}
						</div>
						<!-- End Col -->

						<div class="col-sm-auto order-1 order-sm-2 text-sm-end mb-3">
							<div class="mb-3">
								<h2 class="text-success">{{ strtoupper($invoice->status->name) }}</h2>
								@if ($invoice->status_code == App\Enum\LandlordInvoiceStatusEnum::DUE->value)
									<form action="{{ url('/payment-stripe') }}" method="POST" class="needs-validation">
										<input type="hidden" value="{{ csrf_token() }}" name="_token" />
										<input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
										<button class="btn btn-primary btn-sm" type="submit">
											<i class="bi bi-currency-dollar me-1"></i>Pay Invoice
										</button>
									</form>
								@endif
							</div>
							<div class="mb-3">
								<h3>INVOICE #{{ $invoice->invoice_no }}</h3>
								{{-- <span class="d-block">{{ $invoice->invoice_no }}</span> --}}
							</div>
							<address class="text-dark">
								{{ $config->address1 }}<br>
								@if ($config->address2 <> '' ) 
									{{ $config->address2 }}<br>
								@endif 
								{{ $config->city . ', ' . $config->state . ', ' . $config->zip }}<br>
								{{ $config->relCountry->name }}
							</address>
						</div>
						<!-- End Col -->
					</div>
					<!-- End Row -->

					<div class="row justify-content-md-between mb-3">
						<div class="col-md">
							<h4>BILL TO:</h4>
							<h4>{{ $account->name }}</h4>
							<address>
								{{ $account->address1 }}<br>
								@if ($account->address2 <> '' ) 
									{{ $account->address2 }}<br>
								@endif 
								{{ $account->city . ', ' . $account->state . ', ' . $account->zip }}<br>
								{{ $account->relCountry->name }}
							</address>
						</div>
						<!-- End Col -->

						<div class="col-md text-md-end">
							<dl class="row">
								<dt class="col-sm-8">Invoice date:</dt>
								<dd class="col-sm-4">{{ date('d-M-Y', strtotime($invoice->invoice_date)) }}</dd>
							</dl>
							<dl class="row">
								<dt class="col-sm-8">Due date:</dt>
								<dd class="col-sm-4">{{ date('d-M-Y', strtotime($invoice->due_date)) }} </dd>
							</dl>
						</div>
						<!-- End Col -->
					</div>
					<!-- End Row -->

					<!-- Table -->
					<div class="table-responsive">
						<table class="table table-borderless table-nowrap table-align-middle">
							<thead class="thead-light">
								<tr>
									<th>DESCRIPTION</th>
									<th class="table-text-end">QTY</th>
									<th class="table-text-end">UNIT PRICE</th>
									<th class="table-text-end">AMOUNT</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<th>{{ $invoice->summary }}</th>
									<td class="table-text-end">1</td>
									<td class="table-text-end">${{ number_format($invoice->amount,2) }}</td>
									<td class="table-text-end">${{ number_format($invoice->amount,2) }}</td>
								</tr>

							</tbody>
						</table>
					</div>
					<!-- End Table -->

					<hr class="my-5">

					<div class="row justify-content-md-end mb-3">
						<div class="col-md-8 col-lg-7">
							<dl class="row text-sm-end">
								<dt class="col-sm-6">Total:</dt>
								<dd class="col-sm-6">${{ number_format($invoice->amount,2) }}</dd>
								<dt class="col-sm-6">Amount Paid:</dt>
								<dd class="col-sm-6">${{ number_format($invoice->amount_paid,2) }}</dd>
								<dt class="col-sm-6">Due Balance:</dt>
								<dd class="col-sm-6">${{ number_format($invoice->amount-$invoice->amount_paid,2) }}</dd>
							</dl>
							<!-- End Row -->
						</div>
					</div>
					<!-- End Row -->

					<div class="mb-3">
						<h3>Thank you!</h3>
						{{-- <p class="small">If you have any questions concerning this invoice, please create a support ticket via our <a href="{{ route('tickets.create') }}">Support Ticket System </a> or via email at support{{ '@'.config('app.domain') }}</p> --}}
					</div>

					<p class="small mb-0">&copy;{{ date('Y') }} <a href={{ route('home') }}>{{ env('APP_NAME') }}</a></p>
				</div>
			</div>
			<!-- End Card -->

			<!-- Footer -->
			<div class="d-flex justify-content-end d-print-none gap-3">
				{{-- <a class="btn btn-white" href="#">
					<i class="bi-file-earmark-arrow-down me-1"></i> PDF
				</a> --}}
				<a class="btn btn-primary" href="javascript:;" onclick="window.print(); return false;">
					<i class="bi-printer me-1"></i> Print Invoice
				</a>
				@if ( ( $invoice->status_code == \App\Enum\LandlordInvoiceStatusEnum::DUE->value ) || ( $invoice->status_code == \App\Enum\LandlordInvoiceStatusEnum::PASTDUE->value ) )
					<form action="{{ url('/payment') }}" method="POST" class="needs-validation">
						{{-- <form method="POST" class="needs-validation" novalidate> --}}
						<input type="hidden" value="{{ csrf_token() }}" name="_token" />
						<input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
						<button class="btn btn-primary" type="submit">Pay Invoice (Hosted)</button>
					</form>
				@endif
			</div>
			<!-- End Footer -->
		</div>
	</div>

@endsection
