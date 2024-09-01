@extends('layouts.tenant.report')

@section('title','Invoice Register')

@section('data')

		<thead>
			<tr>
				<th class="sl">SL</th>
				<th class="desc">Inv #</th>
				<th class="desc">Date</th>
				<th class="desc">PO# </th>
				<th class="desc">Dept</th>
				<th class="desc">Supplier</th>
				<th class="desc">Particulars</th>
				<th class="desc">CUR.</th>
				<th class="numeric">Amount</th>
				<th class="numeric">Amount<br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0
			@endphp
			@foreach ($invoices as $invoice)
			<tr>
				<td class="sl">{{ $loop->iteration }}</td>
				<td class="desc">{{ $invoice->invoice_no }} </td>
				<td class="desc">{{ date('d-M-y', strtotime($invoice->invoice_date)) }}</td>
				<td class="desc">{{ $invoice->po_id }}</td>
				<td class="desc">{{ $invoice->dept_name }}</td>
				<td class="desc">{{ $invoice->supplier_name }}</td>
				<td class="desc">{{ $invoice->summary }}</td>
				<td class="desc">{{ $invoice->currency }} </td>
				<td class="numeric">{{ number_format($invoice->amount,2) }}</td>
				<td class="numeric">{{ number_format($invoice->fc_amount,2) }}</td>	
			</tr>
			{{-- @empty
				<td olspan="7" class="desc">No Data Found!</td> --}}
				@php 
					$sum = $sum + $invoice->fc_amount;
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