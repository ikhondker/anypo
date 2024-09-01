@extends('layouts.tenant.report')

@section('title','Accounting Entries Report')

@section('data')
	
		<thead>
			<tr>
				<th class="sl">#</th>
				<th class="desc">Entity</th>
				<th class="desc">Event</th>
				<th class="desc">Date</th>
				<th class="desc">Account</th>
				<th class="sl">Line</th>
				<th class="desc">PO#</th>
				<th class="desc">Reference</th>
				<th class="desc">Currency</th>
				<th class="numeric">Dr({{ $_setup->currency }})</th>
				<th class="numeric">Cr({{ $_setup->currency }})</th>
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
				<td class="desc">{{ $ael->source_entity }}</td>
				<td class="desc">{{ $ael->event }}</td>
				<td class="desc">{{ date('d-M-y', strtotime($ael->accounting_date)) }}</td>
				<td class="desc">{{ $ael->ac_code }}</td>
				<td class="desc">{{ $ael->line_description }}</td>
				<td class="desc">{{ $ael->po_id }}</td>
				<td class="desc">{{ $ael->reference_no }}</td>
				<td class="desc">{{ $ael->fc_currency }}</td>
				<td class="numeric">{{ number_format($ael->fc_dr_amount,2) }}</td>
				<td class="numeric">{{ number_format($ael->fc_cr_amount,2) }}</td>
			</tr>
				@php 
					$sum_dr = $sum_dr + $ael->fc_dr_amount;
					$sum_cr = $sum_cr + $ael->fc_cr_amount;
				@endphp
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="9" style="text-align: right;"><strong>TOTAL ({{ $_setup->currency }}):</strong></td>
				<td style="text-align: right;">{{ number_format($sum_dr,2) }}</td>
				<td style="text-align: right;">{{ number_format($sum_cr,2) }}</td>
			</tr>
		</tfoot>
	

@endsection