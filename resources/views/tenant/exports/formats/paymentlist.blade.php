@extends('layouts.tenant.report')

@section('title','Payment Register')

@section('data')

		<thead>
			<tr>
				<th class="unit">SL</th>
				<th class="desc">Payment#</th>
				<th class="desc">Date</th>
				<th class="desc">Bank AC</th>
				<th class="desc">Cheque NO</th>
				<th class="desc">CUR.</th>
				<th class="numeric">Amount</th>
				<th class="desc">PO# </th>
				<th class="desc">Dept</th>
				<th class="numeric">Amount <br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php
				$sum = 0
			@endphp
			@foreach ($payments as $payment)
			<tr>
				<td class="sl">{{ $loop->iteration }}</td>
				<td class="desc">{{ $payment->id }}</td>
				<td class="desc">{{ date('d-M-y', strtotime($payment->pay_date)) }}</td>
				<td class="desc">{{ $payment->ac_name }}</td>
				<td class="desc">{{ $payment->cheque_no }}</td>
				<td class="desc">{{ $payment->currency }}</td>
				<td class="numeric">{{ number_format($payment->amount,2) }}</td>
				<td class="desc">{{ $payment->po_id }}</td>
				<td class="desc">{{ $payment->dept_name }}</td>
				<td class="numeric">{{ number_format($payment->fc_amount,2) }}</td>
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
				<td colspan="9" style="text-align: right;"><strong>TOTAL ({{ $_setup->currency }}):</strong></td>
				<td style="text-align: right;">{{ number_format($sum,2) }}</td>
			</tr>
		</tfoot>


@endsection
