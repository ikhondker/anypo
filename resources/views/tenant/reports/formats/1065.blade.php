@extends('layouts.tenant.landscape')

@section('title','Project Spend Report')
{{-- @section('breadcrumb','Create Pr') --}}

@section('content')

	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="unit">SL#</th>
				<th class="unit">PO#</th>
				<th class="unit">DATE</th>
				<th class="unit">SUMMARY</th>
				<th class="unit">DEPT</th>
				<th class="unit">SUPPLIER</th>
				<th class="unit">CUR.</th>
				<th class="unit">AMOUNT</th>
				<th class="unit">GRS</th>
				<th class="unit">INVOICE</th>
				<th class="unit">PAYMENT</th>
				<th class="unit">AMOUNT <br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0;
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
				<td class="qty">{{ number_format($po->amount,2) }}</td>
				<td class="qty">{{ number_format($po->amount_grs,2) }}</td>
				<td class="qty">{{ number_format($po->amount_invoice,2) }}</td>
				<td class="qty">{{ number_format($po->amount_paid,2) }}</td>	
				<td class="qty">{{ number_format($po->fc_amount,2) }}</td>	
			</tr>
				@php 
					$sum = $sum + $po->fc_amount;
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