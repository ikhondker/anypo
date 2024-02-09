@extends('layouts.landscape')

@section('title','Requisition Lines2')
{{-- @section('breadcrumb','Create Pr') --}}

@section('content')

	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="unit">#</th>
				
				<th class="unit">PR#</th>
				<th class="unit">LINE#</th>
				<th class="unit">DESCRIPTION</th>
				<th class="unit">DEPT</th>
				<th class="unit">UOM</th>
				<th class="unit">UNIT<br> PRICE</th>
				<th class="unit">CUR.</th>
				<th class="unit">QTY</th>
				<th class="unit">AMOUNT</th>
				<th class="unit">AMOUNT <br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0
			@endphp
			@foreach ($pols as $pol)
			<tr>
				<td class="desc">{{ $pols->firstItem() + $loop->index }}</td>
				<td class="desc">{{ $pol->po_id }}</td>
				<td class="desc">{{ $pol->line_num }}</td>
				<td class="desc" width="40%">{{ $pol->summary }}</td>
				<td class="desc">{{ $pol->dept_name }}</td>
				<td class="desc">{{ $pol->uom_name }} </td>
				<td class="qty">{{ number_format($pol->price,2) }}</td>
				<td class="desc">{{ $pol->currency }} </td>
				<td class="qty">{{ $pol->qty }}</td>
				<td class="qty">{{ number_format($prl->amount,2) }}</td>
				<td class="qty">{{ number_format($prl->fc_amount,2) }}</td>	
			</tr>
			{{-- @empty
				<td olspan="7" class="desc">No Data Found!</td> --}}
				@php 
					$sum = $sum + $prl->fc_amount;
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