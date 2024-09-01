@extends('layouts.tenant.report')

@section('title','Goods Receipt Register')

@section('data')

	
		<thead>
			<tr>
				<th class="sl">SL</th>
				<th class="desc">GRN#</th>
				<th class="desc">Date</th>
				<th class="desc">Warehouse</th>
				<th class="desc">Dept</th>
				<th class="desc">PO# </th>
				<th class="sl">LN#</th>
				<th class="desc">Description</th>
				<th class="desc">UoM</th>
				<th class="numeric">Qty</th>
				<th class="numeric">Amount <br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0
			@endphp
			@foreach ($receipts as $receipt)
			<tr>
				<td class="sl">{{ $loop->iteration }}</td>
				<td class="desc">{{ $receipt->id }} </td>
				<td class="desc">{{ date('d-M-y', strtotime($receipt->receive_date)) }}</td>
				<td class="desc">{{ $receipt->warehouse_name }}</td>
				<td class="desc">{{ $receipt->dept_name }}</td>
				<td class="desc">{{ $receipt->po_id }}</td>
				<td class="sl">{{ $receipt->line_num }}</td>
				<td class="desc">{{ $receipt->item_description }}</td>
				<td class="desc">{{ $receipt->uom_name }} </td>
				<td class="numeric">{{ number_format($receipt->rcv_qty,2) }}</td>
				<td class="numeric">{{ number_format($receipt->fc_amount,2) }}</td>	
			</tr>
			{{-- @empty
				<td olspan="7" class="desc">No Data Found!</td> --}}
				@php 
					$sum = $sum + $receipt->fc_amount;
				@endphp
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="10" style="text-align: right;"><strong>TOTAL ({{ $_setup->currency }}):</strong></td>
				<td style="text-align: right;">{{ number_format($sum,2) }}</td>		
			</tr>
		</tfoot>
	

@endsection