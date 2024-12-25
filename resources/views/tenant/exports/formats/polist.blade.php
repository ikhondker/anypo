@extends('layouts.tenant.report')

@section('title','Purchase Order Listing')

@section('data')

	<thead>
		<tr>
			<th class="sl">SL</th>
			<th class="desc">PO#</th>
			<th class="desc">Date</th>
			<th class="desc">Summary</th>
			<th class="desc">Requestor</th>
			<th class="desc">Dept</th>
			<th class="desc">Supplier</th>
			<th class="desc">Project</th>
			<th class="desc">CUR.</th>
			<th class="numeric">Amount</th>
			<th class="numeric">Amount<br>({{ $_setup->currency }})</th>
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
			<td class="desc">{{ $po->requestor }}</td>
			<td class="desc">{{ $po->dept }}</td>
			<td class="desc">{{ $po->supplier }}</td>
			<td class="desc">{{ $po->project }}</td>
			<td class="desc">{{ $po->currency }}</td>
			<td class="numeric">{{ number_format($po->amount,2) }}</td>
			<td class="numeric">{{ number_format($po->fc_amount,2) }}</td>
		</tr>
		{{-- @empty
			<td olspan="7" class="desc">No Data Found!</td> --}}
			@php
				$sum = $sum + $po->fc_amount;
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

