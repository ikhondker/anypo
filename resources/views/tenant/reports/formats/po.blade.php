{{-- @extends('layouts.tenant.portrait') --}}
@extends('layouts.tenant.report', ['info' => true,'padding' => true])

@section('title','Purchase Order Report')

@section('info1')
	Summary: <strong>{{ $po->summary }}</strong></br>
	Requestor: {{ $po->requestor->name }}</br>
	Date: {{ strtoupper(date('d-M-Y', strtotime($po->po_date))) }}
@endsection

@section('info2')
	Department: {{ $po->dept->name }}</br>
	Project: {{ $po->project->name }}</br>
	Vendor: {{ $po->supplier->name }}
@endsection


@section('data')
	<thead>
		<tr>
			<th class="sl">#</th>
			<th class="desc" width='35%'>Description</th>
			<th class="desc">UoM</th>
			<th class="numeric">Unit Price</th>
			<th class="numeric">Qty</th>
			<th class="numeric">Sub-Total</th>
			<th class="numeric">Tax</th>
			<th class="numeric">GST</th>
			<th class="numeric">Amount</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($pols as $pol)
			<tr>
				<td class="sl">{{ $pol->line_num }}</td>
				<td class="desc">{{ $pol->item_description }}</td>
				<td class="desc">{{ $pol->item->uom->name }}</td>
				<td class="numeric">{{ number_format($pol->price,2) }}</td>
				<td class="numeric">{{ $pol->qty }}</td>
				<td class="numeric">{{ number_format($pol->sub_total,2) }}</td>
				<td class="numeric">{{ number_format($pol->tax,2) }}</td>
				<td class="numeric">{{ number_format($pol->gst,2) }}</td>
				<td class="numeric">{{ number_format($pol->amount,2) }}</td>
			</tr>
		@endforeach
	</tbody>

	<tfoot>
		<tr>
			<td colspan="8" style="text-align: right;"><strong>TOTAL ({{ $po->currency }}):</strong></td>
			<td style="text-align: right;">{{ number_format($po->amount,2) }}</td>
		</tr>
	</tfoot>

@endsection


@section('notes')
	NOTES: <br>
	{!! nl2br( $po->notes ) !!}<br><br>
	TERMS & CONDITIONS:</br>
	{!! nl2br( $setup->tc ) !!}
@endsection



