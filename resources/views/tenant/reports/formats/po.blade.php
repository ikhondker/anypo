@extends('layouts.portrait')

@section('title','Purchase Order Portrait')
{{-- @section('breadcrumb','Create Pr') --}}

@section('header')
	<div id="details" class="clearfix">
		<div id="client">
			<div class="to">REQUESTOR:</div>
			<h2 class="name">{{ $po->requestor->name }}</h2>
			{{-- <div class="address">{{ $po->requestor->name }}</div> --}}
			{{-- <div class="address">{{ $po->requestor->designation_name->name }}, {{ $po->requestor->dept_name->name }}</div> --}}
			<div class="address">Project: {{ $po->project->name }}</div>
			<div class="address">Dept: {{ $po->dept->name }}</div>
			<div class="address">Summary: {{ $po->summary }}</div>
			<div class="address">Vendor: {{ $po->supplier->name }}</div>
			{{-- <div class="address">Amount {{ number_format($po->amount,2) }} {{ $po->currency }}</div> --}}
			{{-- <div class="address">796 Silver Harbour, TX 79273, US</div>
			<div class="email">john@example.com</div> --}}
		</div>
		<div id="invoice">
			<h1>PURCHASE ORDER #{{ $po->id}}</h1>
			{{-- <div class="name">AMOUNT {{ number_format($po->amount,2) }} {{ $po->currency }}</div> --}}
			<div class="date">DATE: {{ strtoupper(date('d-M-Y', strtotime($po->po_date))) }}</div>
			{{-- <div class="date">APPROVAL: {{ strtoupper($po->auth_status->value) }}</div> --}}
			<h2 class="name">AMOUNT: {{ number_format($po->amount,2) }} {{ $po->currency }}</h2>
			<div class="name">APPROVAL: {{ strtoupper($po->auth_status) }}</div>
			{{-- <h2 class="name">APPROVAL {{strtoupper($po->auth_status->value) }}</h2> --}}
			{{-- <div class="date">PROPOSED VENDOR: Apollo Painting & Wallcovering</div> --}}

			{{-- <div class="date">Due Date: 30/06/2014</div> --}}
		</div>
	</div>
@endsection

@section('content')
	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="desc">#</th>
				<th class="desc">DESCRIPTION</th>
				<th class="desc">UOM</th>
				<th class="unit">UNIT PRICE</th>
				<th class="qty">QUANTITY</th>
				<th class="total">AMOUNT</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($pols as $pol)
			<tr>
				<td class="desc">{{ $pol->line_num }}</td>
				<td class="desc">{{ $pol->item_description }}</td>
				<td class="desc">{{ $pol->item->uom->name }} </td>
				<td class="unit">{{ number_format($pol->amount,2) }}</td>
				<td class="qty">{{ $pol->qty }}</td>
				<td class="total">{{ number_format($pol->amount,2) }}</td>
			</tr>
			@endforeach
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
				<td colspan="4"></td>
				<td colspan="1">SUBTOTAL</td>
				<td>  {{ $po->currency }} {{ number_format($po->amount,2) }}</td>
			</tr>
			{{-- <tr>
				<td colspan="2"></td>
				<td colspan="2">TAX 25%</td>
				<td>$1,300.00</td>
			</tr> --}}
			<tr>
				<td colspan="4"></td>
				<td colspan="1">GRAND TOTAL</td>
				<td> {{ $po->currency }} {{ number_format($po->amount,2) }}</td>
			</tr>
		</tfoot>
	</table>

	<div id="notices">
		<div>TERMS & CONDITIONS:</div>
		<div class="notice">{{ $po->notes }}</div>
		@if ($po->tc)
		<div class="notice">{{ $setup->tc }}</div>
		@endif
	</div>

@endsection

		