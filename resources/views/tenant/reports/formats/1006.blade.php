@extends('layouts.landscape')

@section('title','Goods Receipt Register')
{{-- @section('breadcrumb','Create Pr') --}}

@section('content')

	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="unit">SL</th>
				<th class="unit">GRN#</th>
				<th class="unit">RCV DATE</th>
				<th class="unit">WAREHOUSE</th>
				<th class="unit">DEPT</th>
				<th class="unit">PO# </th>
				<th class="unit">LN#</th>
				<th class="unit">DESCRIPTION</th>
				<th class="unit">UOM</th>
				<th class="unit">QTY</th>
				<th class="unit">AMOUNT <br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0
			@endphp
			@foreach ($receipts as $receipt)
			<tr>
				<td class="sl">{{  $loop->iteration }}</td>
				<td class="desc">{{ $receipt->id }} </td>
				<td class="desc">{{ date('d-M-y', strtotime($receipt->receive_date)) }}</td>
				<td class="qty">{{ $receipt->warehouse_name }}</td>
				<td class="desc">{{ $receipt->dept_name }}</td>
				<td class="desc">{{ $receipt->po_id }}</td>
				<td class="sl">{{ $receipt->line_num }}</td>
				<td class="desc">{{ $receipt->summary }}</td>
				<td class="desc">{{ $receipt->uom_name }} </td>
				<td class="qty">{{ number_format($receipt->rcv_qty,2) }}</td>
				<td class="qty">{{ number_format($receipt->fc_amount,2) }}</td>	
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
				<td colspan="7"></td>
				<td colspan="2">TOTAL:</td>
				<td class="qty" colspan="2">{{ $_setup->currency }} {{  number_format($sum,2) }}</td>
			</tr>
		</tfoot>
	</table>

@endsection