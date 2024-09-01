{{-- @extends('layouts.tenant.landscape') --}}
@extends('layouts.tenant.report', ['info' => true,'padding' => true])

@section('title','Requisition')

@section('info1')
	Summary: <strong>{{ $pr->summary }}</strong></br>
	Requestor: {{ $pr->requestor->name }}</br>
	Date: {{ strtoupper(date('d-M-Y', strtotime($pr->pr_date))) }}
@endsection

@section('info2')
	Department: {{ $pr->dept->name }}</br>
	Project: {{ $pr->project->name }}</br>
	Vendor: {{ $pr->supplier->name }} 
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
			<td colspan="8" style="text-align: right;"><strong>TOTAL ({{ $pr->currency }}):</strong></td>
			<td style="text-align: right;">{{ number_format($pr->amount,2) }}</td>
		</tr>
	</tfoot>


@endsection

<!-- ========== THANKS ========== -->
@section('notes')
	NOTES: <br>
	{!! nl2br( $pr->notes ) !!}<br><br>
@endsection
<!-- ========== THANKS ========== -->