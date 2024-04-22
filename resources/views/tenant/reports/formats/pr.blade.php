@extends('layouts.portrait')

@section('title','Requisition portrait')
{{-- @section('breadcrumb','Create Pr') --}}

@section('header')
	<div id="details" class="clearfix">
		<div id="client">
			<div class="to">REQUESTOR:</div>
			<h2 class="name">{{ $pr->requestor->name }}</h2>
			{{-- <div class="address">{{ $pr->requestor->name }}</div> --}}
			{{-- <div class="address">{{ $pr->requestor->designation_name->name }}, {{ $pr->requestor->dept_name->name }}</div> --}}
			<div class="address">Project: {{ $pr->project_id }}</div>
			<div class="address">Summary: {{ $pr->summary }}</div>
			<div class="address">Vendor: {{ $pr->supplier->name }}</div>
			{{-- <div class="address">Amount {{ number_format($pr->amount,2) }} {{ $pr->currency }}</div> --}}
			{{-- <div class="address">796 Silver Harbour, TX 79273, US</div>
			<div class="email">john@example.com</div> --}}
		</div>
		<div id="invoice">
			<h1>REQUISITION #{{ $pr->id}}</h1>
			
			{{-- <div class="name">AMOUNT {{ number_format($pr->amount,2) }} {{ $pr->currency }}</div> --}}
			<div class="date">DATE: {{ strtoupper(date('d-M-Y', strtotime($pr->pr_date))) }}</div>
			{{-- <div class="date">APPROVAL: {{ strtoupper($pr->auth_status->value) }}</div> --}}
			<h2 class="name">AMOUNT {{ number_format($pr->amount,2) }} {{ $pr->currency }}</h2>
			<div class="name">APPROVAL: {{ strtoupper($pr->auth_status) }}</div>
			{{-- <h2 class="name">APPROVAL {{strtoupper($pr->auth_status->value) }}</h2> --}}
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
			@foreach ($prls as $prl)
			<tr>
				<td class="desc">{{ $prl->line_num }}</td>
				<td class="desc">{{ $prl->summary }}</td>
				<td class="desc">{{  $prl->item->uom->name }} </td>
				<td class="unit">{{ number_format($prl->amount,2) }}</td>
				<td class="qty">{{ $prl->qty }}</td>
				<td class="total">{{ number_format($prl->amount,2) }}</td>
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
				<td> {{ $pr->currency }} {{ number_format($pr->amount,2) }}</td>
			</tr>
			{{-- <tr>
				<td colspan="2"></td>
				<td colspan="2">TAX 25%</td>
				<td>$1,300.00</td>
			</tr> --}}
			<tr>
				<td colspan="4"></td>
				<td colspan="1">GRAND TOTAL</td>
				<td> {{ $pr->currency }} {{ number_format($pr->amount,2) }}</td>
			</tr>
		</tfoot>
	</table>

	<!-- ========== THANKS ========== -->
	<div id="notices">
		<div>NOTES:</div>
		<div class="notice">  {!! nl2br( $pr->notes ) !!}</div>
	</div>
	<!-- ========== THANKS ========== -->

@endsection

		