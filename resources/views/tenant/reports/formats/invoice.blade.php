@extends('layouts.tenant.report', ['info' => true])

@section('title','Invoice')

@section('info1')
	Supplier: <strong>{{ $invoice->supplier->name }}</strong></br>
	Invoice #: {{ $invoice->invoice_no }}</br>
	Summary: {{ $invoice->summary }}</br>
	Date: {{ strtoupper(date('d-M-Y', strtotime($invoice->invoice_date))) }}
	@endsection
	
	@section('info2')
	PO #: {{ $invoice->po_id }}</br>
	Summary #: {{ $invoice->po->summary }}</br>
	Project: {{ $invoice->po->project->name }}</br>
	PoC: {{ $invoice->poc->name }}</br>
@endsection

@section('data')
	<thead>
		<tr>
			<th class="sl">#</th>
			<th class="desc" width='35%'>Description</th>
			<th class="numeric">Unit Price</th>
			<th class="numeric">Qty</th>
			<th class="numeric">Sub-Total</th>
			<th class="numeric">Tax</th>
			<th class="numeric">GST</th>
			<th class="numeric">Amount</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($invoiceLines as $invoiceLine)
			<tr>
				<td class="sl">{{ $invoiceLine->line_num }}</td>
				<td class="desc">{{ $invoiceLine->summary }}</td>
				<td class="numeric">{{ number_format($invoiceLine->price,2) }}</td>
				<td class="numeric">{{ $invoiceLine->qty }}</td>
				<td class="numeric">{{ number_format($invoiceLine->sub_total,2) }}</td>
				<td class="numeric">{{ number_format($invoiceLine->tax,2) }}</td>
				<td class="numeric">{{ number_format($invoiceLine->gst,2) }}</td>
				<td class="numeric">{{ number_format($invoiceLine->amount,2) }}</td>
			</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="7" style="text-align: right;"><strong>TOTAL ({{ $invoice->currency }}):</strong></td>
			<td style="text-align: right;">{{ number_format($invoice->amount,2) }}</td>
		</tr>
	</tfoot>


@endsection

<!-- ========== THANKS ========== -->
@section('notes')
	NOTES: <br>
	{!! nl2br( $invoice->notes ) !!}<br><br>
@endsection
<!-- ========== THANKS ========== -->