@extends('layouts.tenant.report')

@section('title','Purchase Order Lines')

@section('data')

	
		<thead>
			<tr>
				<th class="sl">SL</th>
				<th class="desc">PO#</th>
				<th class="desc">Date</th>
				<th class="sl">LN#</th>
				<th class="desc">Description</th>
				<th class="desc">Dept</th>
				<th class="desc">UoM</th>
				<th class="numeric">Unit <br> Price</th>
				<th class="desc">CUR.</th>
				<th class="numeric">Qty</th>
				<th class="numeric">Amount</th>
				<th class="numeric">Amount <br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0
			@endphp
			@foreach ($pols as $pol)
			<tr>
				<td class="sl">{{ $loop->iteration}}</td>
				<td class="desc">{{ $pol->po_id }}</td>
				<td class="desc">{{ date('d-M-y', strtotime($pol->po_date)) }}</td>
				<td class="sl">{{ $pol->line_num }}</td>
				<td class="desc">{{ $pol->item_description }}</td>
				<td class="desc">{{ $pol->dept_name }}</td>
				<td class="desc">{{ $pol->uom_name }} </td>
				<td class="numeric">{{ number_format($pol->price,2) }}</td>
				<td class="desc">{{ $pol->currency }} </td>
				<td class="numeric">{{ $pol->qty }}</td>
				<td class="numeric">{{ number_format($pol->amount,2) }}</td>
				<td class="numeric">{{ number_format($pol->fc_amount,2) }}</td>	
			</tr>
			{{-- @empty
				<td olspan="7" class="desc">No Data Found!</td> --}}
				@php 
					$sum = $sum + $pol->fc_amount;
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