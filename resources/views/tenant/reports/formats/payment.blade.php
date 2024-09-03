{{-- @extends('layouts.tenant.landscape') --}}
@extends('layouts.tenant.report', ['info' => true,'padding' => true])

@section('title','Payment')

	@section('info1')
		Supplier: <strong>{{ $payment->invoice->supplier->name }}</strong></br>
		Invoice #: {{ $payment->invoice->invoice_no }}</br>
		Summary: {{ $payment->invoice->summary }}</br>
		Invoice Date: {{ strtoupper(date('d-M-Y', strtotime($payment->invoice->invoice_date))) }}
	@endsection
	
	@section('info2')
		PO #: {{ $payment->po_id }}</br>
		Summary #: {{ $payment->po->summary }}</br>
		Project: {{ $payment->po->project->name }}</br>
		Payee: {{ $payment->payee->name }}</br>
	@endsection

@section('data')
	<thead>
		<tr>
			<th class="sl">#</th>
			<th class="desc">Date</th>
			<th class="desc">Bank Ac Name</th>
			<th class="desc">Bank Ac #</th>
			<th class="desc">Cheque #</th>
			<th class="desc">Currency</th>
			<th class="desc">Description</th>
			<th class="numeric">Amount</th>
		</tr>
	</thead>
	<tbody>
			<tr>
				<td class="sl">1</td>
				<td class="desc">{{ strtoupper(date('d-M-Y', strtotime($payment->pay_date))) }}</td>
				<td class="desc">{{ $payment->bank_account->ac_name }}</td>
				<td class="desc">{{ $payment->bank_account->ac_number }}</td>
				<td class="desc">{{ $payment->cheque_no }}</td>
				<td class="desc">{{ $payment->currency }}</td>
				<td class="desc">{{ $payment->summary }}</td>
				<td class="numeric">{{ number_format($payment->amount,2) }}</td>
			</tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="7" style="text-align: right;"><strong>TOTAL ({{ $payment->currency }}):</strong></td>
			<td style="text-align: right;">{{ number_format($payment->amount,2) }}</td>
		</tr>
	</tfoot>


@endsection

<!-- ========== THANKS ========== -->
@section('notes')
	NOTES: <br>
	{!! nl2br( $payment->notes ) !!}<br><br>
@endsection
<!-- ========== THANKS ========== -->