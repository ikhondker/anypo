@extends('layouts.tenant.landscape')

@section('title','Invoice Register')
{{-- @section('breadcrumb','Create Pr') --}}

@section('content')

	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="unit">SL</th>
				<th class="unit">INV NO</th>
				<th class="unit">INV DATE</th>
				<th class="unit">PO# </th>
				<th class="unit">DEPT</th>
				<th class="unit">SUPPLIER</th>
				<th class="unit">PARTICULARS</th>
				<th class="unit">CUR.</th>
				<th class="unit">AMOUNT</th>
				<th class="unit">AMOUNT <br>({{ $_setup->currency }})</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum = 0
			@endphp
			@foreach ($invoices as $invoice)
			<tr>
				<td class="sl">{{ $loop->iteration }}</td>
				<td class="desc">{{ $invoice->id }} </td>
				<td class="desc">{{ date('d-M-y', strtotime($invoice->invoice_date)) }}</td>
				<td class="desc">{{ $invoice->po_id }}</td>
				<td class="desc">{{ $invoice->dept_name }}</td>
				<td class="sl">{{ $invoice->supplier_name }}</td>
				<td class="desc">{{ $invoice->summary }}</td>
				<td class="desc">{{ $invoice->currency }} </td>
				<td class="qty">{{ number_format($invoice->amount,2) }}</td>
				<td class="qty">{{ number_format($invoice->fc_amount,2) }}</td>	
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
				<td colspan="6"></td>
				<td colspan="2">TOTAL:</td>
				<td class="qty" colspan="2">{{ $_setup->currency }} {{ number_format($sum,2) }}</td>
			</tr>
		</tfoot>
	</table>

@endsection