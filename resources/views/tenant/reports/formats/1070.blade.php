@extends('layouts.landscape')

@section('title','Accounting Entries Report')

@section('content')

	<table border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th class="unit">#</th>
				<th class="unit">Entity</th>
				<th class="unit">Event</th>
				<th class="unit">Date</th>
				<th class="unit">Account</th>
				<th class="unit">Line</th>
				<th class="unit text-end">Dr({{ $_setup->currency }})</th>
				<th class="unit text-end">Cr({{ $_setup->currency }})</th>
				<th class="unit">Currency</th>
				<th class="unit">PO#</th>
				<th class="unit">Reference</th>
			</tr>
		</thead>
		<tbody>
			@php 
				$sum_dr = 0;
				$sum_cr = 0;
			@endphp
			@foreach ($aels as $ael)
			<tr>
				<td class="sl">{{ $loop->iteration }}</td>
				<td class="desc">{{ $ael->entity }}</td>
				<td class="desc">{{ $ael->event }}</td>
				<td class="desc">{{ date('d-M-y', strtotime($ael->accounting_date)) }}</td>
				<td class="desc">{{ $ael->ac_code }}</td>
				<td class="desc">{{ $ael->line_description }}</td>
				<td class="qty">{{ number_format($ael->fc_dr_amount,2) }}</td>
				<td class="qty">{{ number_format($ael->fc_cr_amount,2) }}</td>
				<td class="desc">{{ $ael->fc_currency }}</td>
				<td class="desc">{{ $ael->po_id }}</td>
				<td class="desc">{{ $ael->reference }}</td>
			</tr>
				@php 
					$sum_dr = $sum_dr + $ael->fc_dr_amount;
					$sum_cr = $sum_cr + $ael->fc_cr_amount;
				@endphp
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4"></td>
				<td colspan="2">TOTAL:</td>
				<td class="qty">{{ $_setup->currency }} {{ number_format($sum_dr,2) }}</td>
				<td class="qty">{{ $_setup->currency }} {{ number_format($sum_cr,2) }}</td>
				<td colspan="3"></td>
			</tr>
		</tfoot>
	</table>

@endsection