@extends('layouts.landlord.app')
@section('title','View Invoice')
@section('breadcrumb','View Invoice')

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

	<!-- Card -->
	<div class="card">

		<div class="card-header border-bottom">
			<h4 class="card-header-title">View Invoice</h4>
		</div>


		<!-- Body -->
		<div class="card-body">
				<x-landlord.show.my-text 	value="{{ $invoice->invoice_no }}" label="Invoice No"/>
				<x-landlord.show.my-date 	value="{{ $invoice->invoice_date }}" label="Invoice Date"/>
				<x-landlord.show.my-badge	value="{{ $invoice->status->name }}" badge="{{ $invoice->status->badge }}" label="Status"/>

				<x-landlord.show.my-text	value="{{ $invoice->summary }}" label="Particulars"/>
				<x-landlord.show.my-date	value="{{ $invoice->from_date }}" label="From Date"/>
				<x-landlord.show.my-date	value="{{ $invoice->to_date }}" label="To Date"/>

				{{-- <x-landlord.show.my-text 	value="{{ $invoice->account->name }}" label="Account"/>
				<x-landlord.show.my-badge		value="{{ $invoice->id }}" label="ID"/>
											--}}
				<x-landlord.show.my-number value="{{ $invoice->price }}" label="Amount"/>
				<x-landlord.show.my-number value="{{ $invoice->amount_paid }}" label="Amount Paid"/>

				<x-landlord.show.my-date value="{{ $invoice->created_at }}" label="Created At:"/>

		</div>
		<!-- End Body -->

		@if (auth()->user()->isSystem())
			<!-- Footer -->
			<div class="card-footer pt-0">
				<div class="d-flex justify-content-end gap-3">
					<a class="btn btn-danger" href="{{ route('invoices.edit',$invoice->id) }}"><i class="bi bi-pencil-square me-1"></i> Edit</a>
				</div>
			</div>
			<!-- End Footer -->
		@endif
	</div>
	<!-- End Card -->
@endsection
