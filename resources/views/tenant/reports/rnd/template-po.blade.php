<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<style>
	/* body {
		font-family: "Sofia", sans-serif;
	} */

	/** Define the margins of your page **/
	@page{
		margin-top: 100px; /* create space for header */
		margin-bottom: 50px; /* create space for footer */
	}
	
	#my-header-table {
		font-family: Arial, Helvetica, sans-serif;
		/* font-family: "Poppins", sans-serif; */
		border-collapse: collapse;
		border: 0px solid white;
		width: 100%;
		font-size: 12px;
		padding-bottom: 8px;
	}
	#my-header-table h1,h3 {
		font-family: Arial, Helvetica, sans-serif;
		margin-top: 0px;
		margin-bottom: 1px;
	}
	/* #my-header-table td {
		text-align: center;
	} */
	#my-header-table table, th, td {
		border: 0px solid white;
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
		font-family: Arial, Helvetica, sans-serif;
		font-size: 10px;
		bottom: 0px;
	}

	#report-footer {
		font-family: Arial, Helvetica, sans-serif;
		/* font-family: "Poppins", sans-serif; */
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

	#my-table {
		font-family: Arial, Helvetica, sans-serif;
		/* font-family: "Poppins", sans-serif; */
		border-collapse: collapse;
		width: 100%;
		font-size: 12px;
	}

	#my-table td, #my-table th {
		border: 1px solid #f2f2f2;
		padding: 15px;
	}

	#my-table tr:nth-child(even){background-color: #f2f2f2;}

	#my-table tr:hover {background-color: #FFFFFF;}

	#my-table th {
		padding-top: 8px;
		padding-bottom: 8px;
		text-align: left;
		background-color: #3F80EA;
		border: 1px solid #3F80EA;
		color: white;
	}

	table.shipToFrom td, table.shipToFrom th{text-align:left}

	header {
		position: fixed;
		top: -60px;
		left: 0px;
		right: 0px;
		height: 50px;
		font-size: 20px !important;

		/** Extra personal styles **/
		background-color: #008B8B;
		color: white;
		text-align: center;
		line-height: 35px;
	}

	footer {
		position: fixed; 
		bottom: -60px; 
		left: 0px; 
		right: 0px;
		height: 50px; 
		font-size: 20px !important;

		/** Extra personal styles **/
		background-color: #008B8B;
		color: white;
		text-align: center;
		line-height: 35px;
	}
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
					This is an electronically generated invoice, No signature is required. <br>Printed By: Iqbal H Khondker at : 8-Jun-22
				</td>
				<td style="text-align:right">
					Page <span class="pagenum"></span>
				</td>
			</tr>
		</table>
	</div>

	{{-- <header>
		Nicesnippets.com
	</header>

	<footer>
		Copyright © <?php echo date("Y");?> 
	</footer> --}}


	<table id="my-header-table">
		<tr>
			<td width="80%" style="text-align:left">
				<h3>{{ $title }}</h3>
				Flat#C3, Plot# 222, Road# 8,Block-C</br>
				Bashundhara R/A , Dhaka -1229</br>
				Phone: 01911310509 email: info@khondker.com, </br>
				Website: 01911310509</br>
				{{-- Facebook https://www.facebook.com/Demo-Shop-for-my-table-103052285788580/</br>
				TIN Number: 9790404436093 --}}
			</td>
			<td style="text-align:right">
				<img src="{{ storage_path('app/logo/logo.png') }}" style="width: 60px">
				<h2>Purchase Order</h2>
				<strong>#1234</strong><br>
				4-Aug-2023
			</td>

		</tr>
	</table>

	<table id="my-table">
		<tr>
			<th style="width:40%; text-align:left">VENDOR</th>
			<th style="width:20%; text-align:left"></th>
			<th style="width:40%; text-align:right">SHIP TO</th>
		</tr>
		<tr>
			<td width="50%" style="text-align:left">
				Apollo Painting & Wallcovering<br/>
				ATTN: <br/>
				535 N. Eucalyptus Ave.<br/>
				Inglewood, CA 90302<br/>
				Phone (310)672-3080
			</td>
		<td>
		</td>
			<td style="text-align:right">
				Apollo Painting & Wallcovering<br/>
				ATTN: <br/>
				535 N. Eucalyptus Ave.<br/>
				Inglewood, CA 90302<br/>
				Phone (310)672-3080
			</td>
		</tr>
	</table>
	
	<table id="my-table">
		<tr>
			<th width="5%">SL#</th>
			<th width="40%">ITEM</th>
			<th width="5%">UNIT</th>
			<th width="10%">QTY</th>
			<th width="20%">PRICE (USD)</th>
			<th width="20%">AMOUNT (USD)</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td> Uniform For The Employees</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Office Equipment Maintenance</td>
			<td>Each</td>
			<td>1</td>
			<td>100.00</td>
			<td style="text-align:right">100.00</td>
		</tr>
		<tr>
			<td colspan="4" rowspan="5">Notes<BR>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada.
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada.
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada.

			</td>
			<td style="text-align:right">Subtotal</td>
			<td style="text-align:right">1100.00</td>
		</tr>
		<tr>
			<td style="text-align:right">Sales Tax (12%)</td>
			<td style="text-align:right">1100.00</td>
		</tr>
		<tr>
			<td style="text-align:right">Shipping</td>
			<td>1100.00</td>
		</tr>
		<tr>
			<td style="text-align:right">Discount (5%)</td>
			<td>1100.00</td>
		</tr>
		<tr>
			<td style="text-align:right">TOTAL (USD)</td>
			<td style="text-align:right">3100.00</td>
		</tr>
	</table>
</body>
</html>


