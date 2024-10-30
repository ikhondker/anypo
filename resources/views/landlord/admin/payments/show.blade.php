@extends('layouts.landlord.app')
@section('title','View Payment')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('payments.index') }}" class="text-muted">Payments</a></li>
	<li class="breadcrumb-item active">#{{ $payment->id }}</li>
@endsection

@section('content')

	{{-- <a href="{{ route('payments.index') }}" class="btn btn-primary float-end"><i class="fas fa-list"></i> View all</a>
	@if (auth()->user()->isSystem())
		<a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-danger float-end"><i class="fas fa-edit"></i> Edit(*)</a>
	@endif --}}

	<a href="{{ route('payments.index') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-list"></i> View all</a>
	<h1 class="h3 mb-3">View Payment</h1>

			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						{{-- <a href="{{ route('payments.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a> --}}
						@if (auth()->user()->isSystem())
							<a class="btn btn-sm btn-danger text-white" href="{{ route('payments.edit', $payment->id) }}"><i class="fas fa-edit"></i> Edit</a>
						@endif
					</div>
				</div>
				<div class="card-body m-sm-3 m-md-5">
					<div class="mb-4">
						Hello <strong>{{ $account->name }}</strong>,
						<br /> This is the receipt for a payment of <strong>${{ number_format($payment->amount,2) }}</strong> (USD) you made to {{ $config->name }}.
					</div>

					<hr class="my-4" />
					<div class="row">
						<div class="col-md-6">
							<div class="text-muted">Payment No.</div>
							<strong>{{ $payment->id }}</strong>
						</div>
						<div class="col-md-6 text-md-right">
							<div class="text-muted">Payment Date</div>
							<strong>{{ strtoupper(date('d-M-Y', strtotime($payment->pay_date))) }}</strong>
						</div>
					</div>

					<hr class="my-4" />

					<div class="row mb-4">
						<div class="col-md-6">
							<div class="text-muted">Client</div>
							<strong>{{ $account->name }}</strong>
							<p>
								{{ $account->address1 }}<br>
								@if ($account->address2 <> '' )
									{{ $account->address2 }}<br>
								@endif
								{{ $account->city . ', ' . $account->state . ', ' . $account->zip }}<br>
								{{ $account->relCountry->name }}<br>
								<a href="#">{{ $account->email }}</a><br>
								{{-- Invoice : #{{ $invoice->invoice_no }}<br> --}}
							</p>
						</div>
						<div class="col-md-6 text-md-right">
							<div class="text-muted">Payment To</div>
							<strong>{{ $config->name }}</strong>
							<p>
								{{ $config->address1 }}<br>
								@if ($config->address2 <> '' )
									{{ $config->address2 }}<br>
								@endif
								{{ $config->city . ', ' . $config->state . ', ' . $config->zip }}<br>
								{{ $config->relCountry->name }} <br>
								<a href="#">{{ $config->email }}</a> <br>
							</p>
						</div>
					</div>

					<table class="table table-sm">
						<thead>
							<tr>
								<th>Description</th>
								<th>Quantity</th>
								<th>Unit Price</th>
								<th class="text-end">Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $invoice->summary }}</td>
								<td>1</td>
								<td>${{ number_format($invoice->amount,2) }}</td>
								<td class="text-end">${{ number_format($invoice->amount,2) }}</td>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Total </th>
								<th class="text-end">${{ number_format($invoice->amount,2) }}</th>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Amount Paid </th>
								<th class="text-end">${{ number_format($invoice->amount_paid,2) }}</th>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Due Balance</th>
								<th class="text-end">${{ number_format($invoice->amount-$invoice->amount_paid,2) }}</th>
							</tr>
						</tbody>
					</table>

					<div class="text-center">
						{{-- <p class="text-sm">
							<strong>Extra note:</strong> Please send all items at the same time to the shipping address. Thanks in advance.
						</p> --}}
						<a class="btn btn-primary" href="javascript:;" onclick="window.print(); return false;">
							<i data-lucide="printer"></i> Print This Receipt
						</a>

					</div>

				</div>
			</div>


@endsection

