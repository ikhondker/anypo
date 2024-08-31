@extends('layouts.tenant.landscape')

@section('title','Payment Register')

@section('content')

	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="unit">SL</th>
				<th class="unit">PAY#</th>
				<th class="unit">PAY DATE</th>
				<th class="unit">BANK AC</th>
				<th class="unit">CHEQUE NO</th>
				<th class="unit">CUR.</th>
				<th class="unit">AMOUNT</th>
				<th class="unit">PO# </th>
				<th class="unit">DEPT</th>
				<th class="unit">AMOUNT <br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0
			@endphp
			@foreach ($payments as $payment)
			<tr>
				<td class="sl">{{ $loop->iteration }}</td>
				<td class="desc">{{ $payment->id }} </td>
				<td class="desc">{{ date('d-M-y', strtotime($payment->pay_date)) }}</td>
				<td class="sl">{{ $payment->ac_name }}</td>
				<td class="desc">{{ $payment->cheque_no }}</td>
				<td class="desc">{{ $payment->currency }} </td>
				<td class="qty">{{ number_format($payment->amount,2) }}</td>
				<td class="desc">{{ $payment->po_id }}</td>
				<td class="desc">{{ $payment->dept_name }}</td>
				<td class="qty">{{ number_format($payment->fc_amount,2) }}</td>	
			</tr>
			{{-- @empty
				<td olspan="7" class="desc">No Data Found!</td> --}}
				@php 
					$sum = $sum + $payment->fc_amount;
				@endphp
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6"></td>
				<td colspan="2">TOTAL:</td>
				<td class="qty" colspan="2">{{ $_setup->currency }} {{ number_format($sum,2) }}</td>
			</tr>
		</tfoot>
	</table>

@endsection