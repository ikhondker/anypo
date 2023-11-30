<!DOCTYPE html>
<html>
<head>
	
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />

<style>
	/** Define the margins of your page **/
	@page{
		margin-top: 50px; /* create space for header */
		margin-bottom: 60px; /* create space for footer */
	}

	body {
	  font-family: "Lato", sans-serif;
	  font-size: 12px;
	}

	
	.letterhead {
	  font-size: 10px;
	  padding: 0px;
	  vertical-align: bottom;
	}

	#my-header-table {
		border-collapse: collapse;
		border: 0px solid white;
		width: 100%;
		padding-bottom: 8px;
	}
	#my-header-table h1, h2, h3 {
		margin-top: 0px;
		margin-bottom: 1px;
		color: #1F9BCF;
	}
	/* #my-header-table td {
		text-align: center;
	} */
	#my-header-table td {
		border: 1px solid #white;
	}

	.header, .footer {
		width: 100%;
		text-align: center;
		position: fixed;
	}

	.header {
		top: 0px;
	}
	
	.footer {
		font-size: 10px;
		bottom: 0px;
	}

	#report-footer {
		border-collapse: collapse;
		width: 100%;
		font-size: 10px;
		padding-bottom: 2px;
		color: #808080;
	}
	#report-footer tr {
		padding-top: 4px;
		border-top: 1px solid #C0C0C0;
	}

	.pagenum:before {
		content: counter(page);
	}

	#my-summary-table {
		border-collapse: collapse;
		border: 0px solid white;
		width: 100%;
		padding-bottom: 10px;
	}

	#my-summary-table th, {
		border: 1px solid #1F9BCF;
		font-weight: normal;
		font-size: 14px;
		padding: 10px;
	}

	#my-table {
		border-collapse: collapse;
		width: 100%;
		font-size: 12px;
	}

	#my-table td, #my-table th {
		border: 1px solid #adb5bd;
		padding: 5px;
	}

	/* #my-table tr:nth-child(even){background-color: #f2f2f2;}

	#my-table tr:hover {background-color: #FFFFFF;} */

	#my-table th {
		padding-top: 8px;
		padding-bottom: 8px;
		text-align: left;
		background-color: #adb5bd;
		border: 1px solid #adb5bd;
		color: #020202;
	}

	#my-total-table {
		border-collapse: collapse;
		width: 100%;
		font-size: 12px;
		/* padding-bottom: 8px; */
	}

	#my-total-table td {
		border: 0px solid #f2f2f2;
		padding: 5px;
	}

	#my-total-table th {
		border: 1px solid #1F9BCF;
		padding: 5px;
	}
	/* table.shipToFrom td, table.shipToFrom th{text-align:left} */

   
</style>
</head>
<body>
	{{-- <div class="header">
		Page <span class="pagenum"></span>
	</div> --}}
	<div class="footer">
		<table id="report-footer">
			<tr>
				<td>
					Printed at {{ date('d-M-Y: h:i:s') }} by {{ auth()->user()->name}}
				</td>
				<td style="text-align:right">
					Page <span class="pagenum"></span>
				</td>
			</tr>
		</table>
	</div>

	<table id="my-header-table">
		<tr>
			<td width="60%" style="text-align:left; vertical-align: bottom;">
				<h1>{{ $setup->name }}</h1>
			</td>
			<td style="text-align:right">
				{{-- <img src="{{ asset('/logo/logo.png') }}" width="75px" height="75px"/><br> --}}
				<img src="{{ storage_path('app/logo/logo.png') }}" style="width: 75px"><br>
			</td>
		</tr>
		<tr>
			<td width="60%" style="text-align:left; vertical-align: bottom;">
				<span class="letterhead">
					{{ $setup->address1 }}<br>
					@if ($setup->address2 <> "")
						{{ $setup->address2 }}<br>
					@endif 
					{{ $setup->city.', '.$setup->state.', '.$setup->zip. ', '.$setup->country  }}<br>
					Phone: {{ $setup->cell }}, email: {{ $setup->email }}, <br>
					Website: {{ $setup->website }}
				</span>
			</td>
			<td style="text-align:right; vertical-align: bottom;">
				<h2>PAYMENT RECEIPT</h2>
				PAYMENT <strong>#{{ $payment->id}}</strong><br>
				DATE: {{ date('d-M-Y') }} <br>
			</td>
		</tr>
	</table>

	<table id="my-summary-table">
		<tr>
			<th colspan="3" text-align="left">[PAYMENT #{{ $payment->id}}] {{ $payment->summary }} amount {{ number_format($payment->amount,2) }} {{ $payment->currency }}.</th>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td style="width:40%; text-align:left;"><strong>ACCOUNT</strong></td>
			<td style="width:20%; text-align:left"></td>
			<td style="width:40%; text-align:right;"><strong>INVOICE</strong></td>
		</tr>
		<tr>
			<td width="50%" style="text-align:left; vertical-align: top;">
				{{ $account->name }}<br>
				{{ $account->address1 }}<br>
					@if ($account->address2 <> "")
						{{ $account->address2 }}<br>
					@endif 
					{{ $account->city.', '.$account->state.', '.$account->zip. ', '.$account->country  }}<br>
					Phone: {{ $account->cell }}, email: {{ $account->email }}, <br>
					Website: {{ $account->website }}
			</td>
		<td>
		</td>
			<td style="text-align:right; vertical-align: top;">
				Invoice #{{ $invoice->id }}<br>
				Invoice Date: {{ date('d-M-y', strtotime($invoice->invoice_date)) }}<br>
				Amount ${{ number_format($invoice->amount,2) }}
			</td>
		</tr>
	</table>
	<br><br>
	<table id="my-summary-table">
		<tr>
			<th colspan="3" text-align="left">
				<h3>Payment Details</h3>
				Payment #{{ $payment->id}}<BR>
				Payment Date: {{ date('d-M-y', strtotime($payment->pay_date)) }}<br>
				Payment Amount: {{ number_format($payment->amount,2) }}{{ $payment->currency }}<br>
			</th>
		</tr>
	</table>

	<br><br>
	<h3>Thank you!</h3>
	<p class="small">If you have any questions concerning this invoice, use the following contact information:</p>
	<p class="small mb-0">&copy;{{ date('Y').' '. env('APP_NAME') }}.</p>

</body>
</html>


