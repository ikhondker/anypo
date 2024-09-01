@extends('layouts.tenant.report')

@section('title','Project Spend Report')

@section('data')


		<thead>
			<tr>
				<th class="unit">SL#</th>
				<th class="desc">PO#</th>
				<th class="desc">Date</th>
				<th class="desc">Summary</th>
				<th class="desc">Dept</th>
				<th class="desc">Supplier</th>
				<th class="desc">CUR.</th>
				<th class="numeric">Amount</th>
				<th class="numeric">GRS</th>
				<th class="numeric">Invocie</th>
				<th class="numeric">Payment</th>
				<th class="numeric">Amount <br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0
			@endphp
			@foreach ($pos as $po)
			<tr>
				<td class="sl">{{ $loop->iteration }}</td>
				<td class="desc">{{ $po->po_id }}</td>
				<td class="desc">{{ date('d-M-y', strtotime($po->po_date)) }}</td>
				<td class="desc">{{ $po->summary }}</td>
				<td class="desc">{{ $po->dept }}</td>
				<td class="desc">{{ $po->supplier }} </td>
				<td class="desc">{{ $po->currency }} </td>
				<td class="numeric">{{ number_format($po->amount,2) }}</td>
				<td class="numeric">{{ number_format($po->amount_grs,2) }}</td>
				<td class="numeric">{{ number_format($po->amount_invoice,2) }}</td>
				<td class="numeric">{{ number_format($po->amount_paid,2) }}</td>	
				<td class="numeric">{{ number_format($po->fc_amount,2) }}</td>	
			</tr>
				@php 
					$sum = $sum + $po->fc_amount;
				@endphp
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="11" style="text-align: right;"><strong>TOTAL ({{ $_setup->currency }}):</strong></td>
				<td style="text-align: right;">{{ number_format($sum,2) }}</td>		
			</tr>
		</tfoot>


@endsection