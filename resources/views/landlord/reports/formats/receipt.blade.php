<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Receipt</title>
		{{-- <link rel="stylesheet" href="style.css" media="all" /> --}}

	<!-- ========== STYLE ========== -->
	@include('landlord.reports.single-page-css')
	<!-- ========== STYLE ========== -->

	</head>
	<body>
		<!-- ========== STYLE ========== -->
		@include('landlord.reports.parts.letterhead')
		<!-- ========== STYLE ========== -->
		<main>
			<div id="details" class="clearfix">
				<div id="client">
					<div class="to">ACCOUNT:</div>
					<h2 class="name">{{ $account->name }}</h2>
					<div class="address">ACCOUNT ID#{{ $account->id }}</div>
					<div class="address">{{ $account->address1.', '. $account->address2 }}</div>
					<div class="address">{{ $account->city.', '.$account->state.', '.$account->zip. ', '.$account->country  }}</div>
					{{-- <div class="address">796 Silver Harbour, TX 79273, US</div>
					<div class="email">john@example.com</div> --}}
				</div>
				<div id="invoice">
					
					<h1>PAYMENT RECEIPT</h1>
					<div class="date">PAYMENT #{{ $payment->id }}</div>
					<div class="date">DATE: {{ strtoupper(date('d-M-y', strtotime($payment->pay_date))) }}</div>
					{{-- <div class="date">STATUS: {{Str::upper($invoice->status->name)}} </div> --}}
					{{-- <div class="date">Due Date: 30/06/2014</div> --}}
				</div>
			</div>
			<table border="0" cellspacing="0" cellpadding="0">
				{{-- <thead>
					<tr>
						<th colspan="5" class="desc">PAYMENT DETAILS</th>
					</tr>
				</thead> --}}
				<tbody>
					<tr>
						
						<td colspan="5" class="desc"><h3>PAYMENT DETAILS</h3>
							<div class="date">PAYMENT #{{ $payment->id }}</div>
							<div class="date">Payment Date: {{ strtoupper(date('d-M-y', strtotime($payment->pay_date))) }}</div>
							<div class="date">Payment Amount: ${{ number_format($payment->amount,2) }}</div>
						</td>
						
					</tr>
					{{-- <tr>
						<td class="no">02</td>
						<td class="desc"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
						<td class="unit">$40.00</td>
						<td class="qty">80</td>
						<td class="total">$3,200.00</td>
					</tr>
					<tr>
						<td class="no">03</td>
						<td class="desc"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
						<td class="unit">$40.00</td>
						<td class="qty">20</td>
						<td class="total">$800.00</td>
					</tr> --}}
				</tbody>
				<tfoot>
					{{-- <tr>
						<td colspan="2"></td>
						<td colspan="2">SUBTOTAL</td>
						<td>${{ number_format($invoice->amount,2) }}</td>
					</tr> --}}
					{{-- <tr>
						<td colspan="2"></td>
						<td colspan="2">TAX 25%</td>
						<td>$1,300.00</td>
					</tr> --}}
					{{-- <tr>
						<td colspan="2"></td>
						<td colspan="2">GRAND TOTAL</td>
						<td>${{ number_format($invoice->amount,2) }}</td>
					</tr> --}}
				</tfoot>
			</table>
			<!-- ========== STYLE ========== -->
			@include('landlord.reports.parts.thankyou')
			<!-- ========== STYLE ========== -->
			
		</main>
		<!-- ========== STYLE ========== -->
		@include('landlord.reports.parts.footer')
		<!-- ========== STYLE ========== -->
	</body>
</html>