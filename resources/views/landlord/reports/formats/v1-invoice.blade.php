<!DOCTYPE html>
<html>
<head>
	
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />

	<!-- ========== STYLE ========== -->
	@include('landlord.reports.style')
	<!-- ========== STYLE ========== -->
</head>
<body>
	{{-- <p>hello world</p> --}}
	{{-- <div class="header">
		Page <span class="pagenum"></span>
	</div> --}}
	<div class="footer">
		<table id="report-footer">
			<tr>
				<td>
					Printed at {{ strtoupper(date('d-M-Y: h:i:s')) }} by {{ auth()->user()->name}}
				</td>
				<td style="text-align:right">
					Page <span class="pagenum"></span>
				</td>
			</tr>
		</table>
	</div>

	<table id="my-header-table">
		<tr>
			<th width="60%" style="text-align:left; vertical-align: bottom;">
				<h1>{{ $setup->name }}</h1>
			</th>
			<th style="text-align:right">
				{{-- <img src="{{ asset('/logo/logo.png') }}" width="75px" height="75px"/><br> --}}
				<img src="{{ storage_path('app/logo/logo.png') }}" style="width: 75px"><br>
			</th>
		</tr>
		<tr>
			<td width="60%" style="text-align:left; vertical-align: bottom;">
				<span class="letterhead">
					{{ $setup->address1 }}<br>
					@if ($setup->address2 <> "")
						{{ $setup->address2 }}<br>
					@endif 
					{{ $setup->city.', '.$setup->state.', '.$setup->zip. ', '.$setup->country  }}<br>
					Cell: {{ $setup->cell }}, email: {{ $setup->email }}, <br>
					{{ $setup->website }}
				</span>
			</td>
			<td style="text-align:right; vertical-align: bottom;">
				<h2>INVOICE</h2>
				INVOICE <strong>#{{ $invoice->id}}</strong><br>
				DATE: {{ strtoupper(date('d-M-Y')) }} <br>
			</td>
		</tr>
	</table>

	<hr>
	<table id="my-summary-table">
		{{-- <tr>
			<th colspan="3" text-align="left">[INVOICE #{{ $invoice->id}}] {{ $invoice->summary }}  amount {{ number_format($invoice->amount,2) }} {{ $invoice->currency }}.</th>
		</tr> --}}
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td style="width:40%; text-align:left;"><strong>BILL TO ACCOUNT</strong></td>
			<td style="width:20%; text-align:left"></td>
			<td style="width:40%; text-align:right;"><strong>INVOICE OWNER</strong></td>
		</tr>
		<tr>
			<td width="50%" style="text-align:left; vertical-align: top;">
				ACCOUNT ID#{{ $account->id }}<br>
				{{ $account->name }}<br>
				{{ $account->address1 }}<br>
					@if ($account->address2 <> "")
						{{ $account->address2 }}<br>
					@endif 
					{{ $account->city.', '.$account->state.', '.$account->zip. ', '.$account->country  }}<br>
					{{-- Phone: {{ $account->cell }}, email: {{ $account->email }}, <br>
					Website: {{ $account->website }} --}}
			</td>
		<td>
		</td>
			<td style="text-align:right; vertical-align: top;">
				{{ $invoice->owner->name }}<br>
				Email: {{ $invoice->owner->email }}, <br>
				Phone: {{ $invoice->owner->cell }}, <br>
			</td>
		</tr>
	</table>

	<p><strong>Particulars:</strong> [INVOICE #{{ $invoice->id}}] {{ $invoice->summary }} amount {{ number_format($invoice->amount,2) }}{{ $invoice->currency }}.</p>

	<table id="my-table">
		<tr>
			<th width="5%">SL#</th>
			<th width="60%">Item</th>
			<th style="text-align:right">Qty</th>
			<th style="text-align:right">Price</th>
			<th style="text-align:right">Amount({{ $invoice->currency }})</th>
		</tr>
		<tr>
			<td>1</td>
			<td>{{ $invoice->summary }}</td>
			<td style="text-align:right">1</td>
			<td style="text-align:right">{{ number_format($invoice->amount,2) }}</td>
			<td style="text-align:right">{{ number_format($invoice->amount,2) }}</td>
		</tr>
		<tr>
			<td width="15%" colspan="4" style="text-align:right">TOTAL:</td>
			<td width="15%" style="text-align:right">{{ number_format($invoice->amount,2) }}</td>
		</tr>
		<tr>
			<td width="15%" colspan="4" style="text-align:right">PAID:</td>
			<td width="15%" style="text-align:right">{{ number_format($invoice->amount_paid,2) }}</td>
		</tr>
		<tr>
			<td width="15%" colspan="4" style="text-align:right">DUE:</td>
			<td width="15%" style="text-align:right">{{ number_format($invoice->amount-$invoice->amount_paid,2) }}</td>
		</tr>

	</table>
	
	<br><br>
	<h3>Thank you!</h3>
	{{-- <p class="small">If you have any questions concerning this invoice, use the following contact information:</p> --}}
	{{-- <p class="small mb-0">&copy;{{ date('Y').' '. $setup->name }}</p> --}}
</body>
</html>


