@extends('layouts.landscape')

@section('title','Requisition Lines2')
{{-- @section('breadcrumb','Create Pr') --}}

@section('content')

	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="unit">#</th>
				<th class="unit">PR#</th>
				<th class="unit">DEPT</th>
				<th class="unit">LINE#</th>
				<th class="unit">DESCRIPTION</th>
				<th class="unit">UOM</th>
				<th class="unit">CURRENCY</th>
				<th class="unit">UNIT PRICE</th>
				<th class="unit">QUANTITY</th>
				<th class="unit">AMOUNT</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0
			@endphp
			@foreach ($prls as $prl)
			<tr>
				<td class="desc">{{ $loop->iteration }}</td>
				<td class="desc">{{ $prl->pr_id }}</td>
				<td class="desc">{{ $prl->dept_name }}</td>
				<td class="desc">{{ $prl->line_num }}</td>
				<td class="desc">{{ $prl->summary }}</td>
				<td class="desc">{{ $prl->uom_name }} </td>
				<td class="desc">{{ $prl->currency }} </td>
				<td class="qty">{{ number_format($prl->price,2) }}</td>
				<td class="qty">{{ $prl->qty }}</td>
				<td class="qty">{{ number_format($prl->amount,2) }}</td>
			</tr>
			{{-- @empty
				<td olspan="7" class="desc">No Data Found!</td> --}}
				@php 
					$sum = $sum + $prl->amount;
				@endphp
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6"></td>
				<td colspan="1">GRAND TOTAL</td>
				<td> {{ $_setup->currency }} {{  number_format($sum,2) }}</td>
			</tr>
		</tfoot>
	</table>

@endsection