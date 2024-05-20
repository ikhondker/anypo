{{-- @extends('layouts.portrait') --}}
@extends('layouts.landscape')

@section('title','Requisition portrait')
{{-- @section('breadcrumb','Create Pr') --}}

@section('header')
	<div id="details" class="clearfix">
		<div id="client">
			<div class="to">REQUESTOR:</div>
			<h2 class="name">{{ $pr->requestor->name }}</h2>
			{{-- <div class="address">{{ $pr->requestor->name }}</div> --}}
			{{-- <div class="address">{{ $pr->requestor->designation_name->name }}, {{ $pr->requestor->dept_name->name }}</div> --}}
			<div class="address">Project: {{ $pr->project->name }}</div>
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
                <tbody>
                   <tr>
                        <td class="xsl">
                            <div class="desc">Summary:<strong> {{ $pr->summary }}</strong></div>
			                <div class="desc">Proposed Vendor: {{ $pr->supplier->name }}</div>
                        </td>
                        <td class="xsl">
                            <div class="numeric">Project: {{ $pr->project->name }}</div>
                            <div class="numeric">Department: {{ $pr->dept->name }}</div>
                        </td>
                    </tr>
                <tbody>
           	</table>

	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="sl">#</th>
				<th class="desc">DESCRIPTION</th>
				<th class="desc">UOM</th>
				<th class="numeric">UNIT PRICE</th>
				<th class="numeric">QUANTITY</th>

				<th class="numeric">SUBTOTAL</th>
                <th class="numeric">TAX</th>
                <th class="numeric">GST</th>

				<th class="numeric">AMOUNT</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($prls as $prl)
			<tr>
				<td class="sl">{{ $prl->line_num }}</td>
				<td class="desc">{{ $prl->item_description }}</td>
				<td class="desc">{{ $prl->item->uom->name }} </td>
				<td class="numeric">{{ number_format($prl->price,2) }}</td>
				<td class="numeric">{{ $prl->qty }}</td>

                <td class="numeric">{{ number_format($prl->sub_total,2) }}</td>
                <td class="numeric">{{ number_format($prl->tax,2) }}</td>
                <td class="numeric">{{ number_format($prl->gst,2) }}</td>


                <td class="numeric">{{ number_format($prl->amount,2) }}</td>


			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6"></td>
				<td colspan="2">TOTAL:</td>
				<td> {{ $pr->currency }} {{ number_format($pr->amount,2) }}</td>
			</tr>
		</tfoot>
	</table>

	<!-- ========== THANKS ========== -->
	<div id="notices">
		<div>NOTES:</div>
		<div class="notice"> {!! nl2br( $pr->notes ) !!}</div>
	</div>
	<!-- ========== THANKS ========== -->

@endsection

