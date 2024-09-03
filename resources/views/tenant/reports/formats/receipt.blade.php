{{-- @extends('layouts.tenant.landscape') --}}
@extends('layouts.tenant.report', ['info' => true,'padding' => true])

@section('title','Payment')

	@section('info1')
		PO #: {{ $receipt->pol->po_id }}</br>
		Summary: {{ $receipt->pol->po->summary }}</br>
		Line # {{ $receipt->pol->line_num }}: {{ $receipt->pol->item_description }}</br>
		Ord Qty: {{ $receipt->pol->qty }}</br>
	@endsection
	@section('info2')
		Supplier: <strong>{{ $receipt->pol->po->supplier->name }}</strong></br>
		Receiver: {{ $receipt->receiver->name }}</br>
		Rcv Date: {{ strtoupper(date('d-M-Y', strtotime($receipt->receive_date))) }}
		{{-- 
		Summary #: {{ $receipt->po->summary }}</br>
		Project: {{ $receipt->po->project->name }}</br>
	 	--}}
	@endsection

@section('data')
	<thead>
		<tr>
			<th class="sl">#</th>
			<th class="desc">Item Code</th>
			<th class="desc">Item Description</th>
			<th class="desc">Date</th>
			<th class="desc">Warehouse</th>
			<th class="desc">UoM</th>
			<th class="numeric">Rcv Qty</th>
			<th class="numeric">Unit Price</th>
			<th class="numeric">Amount</th>
		</tr>
	</thead>
	<tbody>
			<tr>
				<td class="sl">1</td>
				<td class="desc">{{ $receipt->pol->item->code }}</td>
				<td class="desc">{{ $receipt->pol->item_description }}</td>
				<td class="desc">{{ strtoupper(date('d-M-Y', strtotime($receipt->receive_date))) }}</td>
				<td class="desc">{{ $receipt->warehouse->name }}</td>
				<td class="desc">{{ $receipt->pol->uom->name }}</td>
				<td class="numeric">{{ $receipt->qty }}</td>
				<td class="numeric">{{ number_format($receipt->price,2) }}</td>
				<td class="numeric">{{ number_format($receipt->amount,2) }}</td>
			</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="8" style="text-align: right;"><strong>TOTAL ({{ $receipt->pol->po->currency }}):</strong></td>
			<td style="text-align: right;">{{ number_format($receipt->amount,2) }}</td>
		</tr>
	</tfoot>


@endsection

<!-- ========== THANKS ========== -->
@section('notes')
	NOTES: <br>
	{!! nl2br( $receipt->notes ) !!}<br><br>
@endsection
<!-- ========== THANKS ========== -->