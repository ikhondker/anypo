@extends('layouts.tenant.report')

@section('title','Requisition Detail Report')

@section('data')

	<thead>
		<tr>
			<th class="sl">SL</th>
			<th class="desc">PR#</th>
			<th class="desc">Date</th>
			<th class="sl">LN#</th>
			<th class="desc">Description</th>
			<th class="desc">Dept</th>
			<th class="desc">UoM</th>
			<th class="numeric">Unit<br> Price</th>
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
		@foreach ($prls as $prl)
		<tr>
			<td class="sl">{{ $loop->iteration }}</td>
			<td class="desc">{{ $prl->pr_id }}</td>
			<td class="desc">{{ date('d-M-y', strtotime($prl->pr_date)) }}</td>
			<td class="sl">{{ $prl->line_num }}</td>
			<td class="desc">{{ $prl->item_description }}</td>
			<td class="desc">{{ $prl->dept_name }}</td>
			<td class="desc">{{ $prl->uom_name }}</td>
			<td class="numeric">{{ number_format($prl->price,2) }}</td>
			<td class="desc">{{ $prl->currency }}</td>
			<td class="numeric">{{ $prl->qty }}</td>
			<td class="numeric">{{ number_format($prl->amount,2) }}</td>
			<td class="numeric">{{ number_format($prl->fc_amount,2) }}</td>
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
			<td colspan="11" style="text-align: right;"><strong>TOTAL ({{ $_setup->currency }}):</strong></td>
			<td style="text-align: right;">{{ number_format($sum,2) }}</td>
		</tr>
	</tfoot>


@endsection

@section('content')

	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="unit">SL</th>
				<th class="unit">PR#</th>
				<th class="unit">REQ. DATE</th>
				<th class="unit">LN#</th>
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
			@foreach ($prls as $prl)
			<tr>
				<td class="sl">{{ $loop->iteration }}</td>
				<td class="desc">{{ $prl->pr_id }}</td>
				<td class="desc">{{ date('d-M-y', strtotime($prl->pr_date)) }}</td>
				<td class="sl">{{ $prl->line_num }}</td>
				<td class="desc">{{ $prl->item_description }}</td>
				<td class="desc">{{ $prl->dept_name }}</td>
				<td class="desc">{{ $prl->uom_name }}</td>
				<td class="qty">{{ number_format($prl->price,2) }}</td>
				<td class="desc">{{ $prl->currency }}</td>
				<td class="qty">{{ $prl->qty }}</td>
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
				<td colspan="8"></td>
				<td colspan="2">TOTAL:</td>
				<td class="qty" colspan="2">{{ $_setup->currency }} {{ number_format($sum,2) }}</td>
			</tr>
		</tfoot>
	</table>

@endsection
