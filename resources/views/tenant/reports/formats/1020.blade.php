@extends('layouts.tenant.landscape')
@section('title','Requisition Lines')
{{-- @section('breadcrumb','Create Pr') --}}

@section('content')

	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="unit">SL</th>
				<th class="unit">PR#</th>
				<th class="unit">DATE</th>
				<th class="unit">SUMMARY</th>
				<th class="unit">REQUESTOR</th>
				<th class="unit">DEPT</th>
				<th class="unit">SUPPLIER</th>
				<th class="unit">PROJECT</th>
				<th class="unit">CUR.</th>
				<th class="unit">AMOUNT</th>
				<th class="unit">AMOUNT <br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0
			@endphp
			@foreach ($prs as $pr)
			<tr>
				<td class="sl">{{ $loop->iteration }}</td>
				<td class="desc">{{ $pr->pr_id }}</td>
				<td class="desc">{{ date('d-M-y', strtotime($pr->pr_date)) }}</td>
				<td class="desc">{{ $pr->summary }}</td>
				<td class="desc">{{ $pr->requestor }}</td>
				<td class="desc">{{ $pr->dept }}</td>
				<td class="desc">{{ $pr->supplier }} </td>
				<td class="desc">{{ $pr->project }}</td>
				<td class="desc">{{ $pr->currency }} </td>
				<td class="qty">{{ number_format($pr->amount,2) }}</td>
				<td class="qty">{{ number_format($pr->fc_amount,2) }}</td>	
			</tr>
			{{-- @empty
				<td olspan="7" class="desc">No Data Found!</td> --}}
				@php 
					$sum = $sum + $pr->fc_amount;
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