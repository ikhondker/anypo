
@extends('layouts.landlord.pdf-portrait')

@section('title','Invoice')

@section('header')
	<div id="details" class="clearfix">
		<div id="client">
			<div class="to">INVOICE TO:</div>
			<h2 class="name">{{ $account->name }}</h2>
			<div class="address">ACCOUNT ID#{{ $account->id }}</div>
			<div class="address">{{ $account->address1.', '. $account->address2 }}</div>
			<div class="address">{{ $account->city.', '.$account->state.', '.$account->zip. ', '.$account->country }}</div>
			{{-- <div class="address">796 Silver Harbour, TX 79273, US</div>
			<div class="email">john@example.com</div> --}}
		</div>
		<div id="invoice">
			<h1>INVOICE #{{ $invoice->invoice_no}}</h1>
			<div class="date">DATE: {{ strtoupper(date('d-M-Y', strtotime($invoice->invoice_date))) }}</div>

			<div class="date">STATUS: {{ Str::upper($invoice->status->name) }} </div>
			{{-- <div class="date">Due Date: 30/06/2014</div> --}}
		</div>
	</div>
@endsection

@section('content')
<table border="0" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th class="no">#</th>
			<th class="desc">DESCRIPTION</th>
			<th class="unit">UNIT PRICE</th>
			<th class="qty">QUANTITY</th>
			<th class="total">AMOUNT</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="no">01</td>
			<td class="desc"><h3>{{ Str::upper($invoice->invoice_type) }}</h3>{{ $invoice->summary }}</td>
			<td class="unit">${{ number_format($invoice->amount,2) }}</td>
			<td class="qty">1</td>
			<td class="total">${{ number_format($invoice->amount,2) }}</td>
		</tr>
		{{-- <tr>
			<td class="no">02</td>
			<td class="desc"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
			<td class="unit">$40.00</td>
			<td class="qty">80</td>
			<td class="total">$3,200.00</td>
		</tr>
		<tr>
			<td class="no">03</td>
			<td class="desc"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
			<td class="unit">$40.00</td>
			<td class="qty">20</td>
			<td class="total">$800.00</td>
		</tr> --}}
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2"></td>
			<td colspan="2">SUBTOTAL</td>
			<td>${{ number_format($invoice->amount,2) }}</td>
		</tr>
		{{-- <tr>
			<td colspan="2"></td>
			<td colspan="2">TAX 25%</td>
			<td>$1,300.00</td>
		</tr> --}}
		<tr>
			<td colspan="2"></td>
			<td colspan="2">GRAND TOTAL</td>
			<td>${{ number_format($invoice->amount,2) }}</td>
		</tr>
	</tfoot>
</table>
@endsection

