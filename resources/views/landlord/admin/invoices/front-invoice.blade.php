@extends('layouts.landlord.blank')
@section('title', 'View Invoice')
@section('breadcrumb', 'View Invoice')


@section('content')

<h1 class="h3 mb-3">Invoice</h1>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body m-sm-3 m-md-5">
				<div class="mb-4">
					Hello <strong>Chris Wood</strong>,
					<br /> This is the receipt for a payment of <strong>$268.00</strong> (USD) you made to AppStack.
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="text-muted">Payment No.</div>
						<strong>741037024</strong>
					</div>
					<div class="col-md-6 text-md-right">
						<div class="text-muted">Payment Date</div>
						<strong>June 2, 2023 - 03:45 pm</strong>
					</div>
				</div>

				<hr class="my-4" />

				<div class="row mb-4">
					<div class="col-md-6">
						<div class="text-muted">Client</div>
						<strong>
			  Chris Wood
			</strong>
						<p>
							4183 Forest Avenue <br> New York City <br> 10011 <br> USA <br>
							<a href="#">
			chris.wood@gmail.com
		  </a>
						</p>
					</div>
					<div class="col-md-6 text-md-right">
						<div class="text-muted">Payment To</div>
						<strong>
			  AppStack LLC
			</strong>
						<p>
							354 Roy Alley <br> Denver <br> 80202 <br> USA <br>
							<a href="#">
			info@appstack.com
		  </a>
						</p>
					</div>
				</div>

				<table class="table table-sm">
					<thead>
						<tr>
							<th>Description</th>
							<th>Quantity</th>
							<th class="text-end">Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>AppStack Theme Customization</td>
							<td>2</td>
							<td class="text-end">$150.00</td>
						</tr>
						<tr>
							<td>Monthly Subscription </td>
							<td>3</td>
							<td class="text-end">$25.00</td>
						</tr>
						<tr>
							<td>Additional Service</td>
							<td>1</td>
							<td class="text-end">$100.00</td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<th>Subtotal </th>
							<th class="text-end">$275.00</th>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<th>Shipping </th>
							<th class="text-end">$8.00</th>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<th>Discount </th>
							<th class="text-end">5%</th>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<th>Total </th>
							<th class="text-end">$268.85</th>
						</tr>
					</tbody>
				</table>

				<div class="text-center">
					<p class="text-sm">
						<strong>Extra note:</strong> Please send all items at the same time to the shipping address. Thanks in advance.
					</p>

					<a href="#" class="btn btn-primary">
			Print this receipt
		  </a>
				</div>
			</div>
		</div>
	</div>
</div>


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
						<table class="table table-borderless table-align-middle">
							<thead class="thead-light">
								<tr>
									<th style="width:40%">DESCRIPTION</th>
									<th class="table-text-end">QTY</th>
									<th class="table-text-end">UNIT PRICE</th>
									<th class="table-text-end">AMOUNT</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ $invoice->summary }}</td>
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
