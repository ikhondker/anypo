<!DOCTYPE html>
<html>
<head>
	
	<title>@yield('title', 'Reports')</title>
	<style type="text/css">
		/* CSS for styling the invoice */
		body {
			font-family: "Inter", sans-serif;
			font-size: 14px;
			/* margin-top: 2cm;
			margin-left: 2cm;
			margin-right: 2cm;
			 */
			 margin-bottom: 1cm;
		}

		
		table {
			border-collapse: collapse;
			width: 100%;
		}
		#data th, td {
			border: 1px solid silver;
			padding: 8px;
		}
		#data th {
			text-align: left;
			background-color: #f2f2f2;
		}

		/* added styles */
		.logo {
			width: 100px;
			height: 100px;
			float:right;
		}
		.company-name {
			font-size: 24px;
			font-weight: bold;
			float:left;
			margin-left: 10px;
		}
		.invoice-header {
			clear: both;
		}
		.invoice-from-to {
			width: 100%;
			display: flex;
		}
		.invoice-from, .invoice-to {
			width: 50%;
			padding: 10px;
		}

		/* Custom  Iqbal */

		/** Define the margins of your page **/
		/* @page {
                margin: 0cm 0cm;
            } */

		.address {
			font-size: 12px;
			width: 50%;
			margin: 0px;
			padding: 3px;
		}

		.title {
			text-align: center;
			font-size: 12px;
			margin: 0px;
			padding: 3px;
		}

		h2, h3 {
			margin: 0;
			padding: 0;
		}
		hr {
	  		border-top: 1px solid silver;
		}
		#letterhead td, th {
		  	border: none;
		}

		#footer td, th {
		  	/* border: none; */
			border-left: none;
			border-bottom: none;
			border-right: none;

		}

		table .sl {
				text-align: center;
		}

		table .desc {
			text-align: left;
		}

		table .numeric {
			text-align: right;
		}

		footer {
			position: fixed; 
            bottom: 0cm; 
            left: 0cm; 
            right: 0cm;
            height: 1cm;
		
		}
		#pagenum {
			float: right;
			text-align: right;
		}
		.pagenum:before {
			content: counter(page);
		}

		

	</style>
</head>
<body>
	<!-- ========== FOOTER ========== -->
	<footer>
		
		<table id="footer">
			<tr>
				<td width='70%' style='font-size:10px;' valign='top' >
					Printed at: {{ now()->format('d-M-Y H:i:s') }} by
						@if(Auth::check())
							{{ auth()->user()->name }}
						@else
							Guest
						@endif
						from {{ URL::current() }}
				</td>
				
				<td width='30%' style='font-size:10px;' align='right' valign='top'>
					<div id="pagenum">
						Page <span class="pagenum"></span>
					</div>
				</td>
			</tr>
		</table>
	</footer>
	<!-- ========== FOOTER ========== -->

	<!-- ========== LETTERHEAD ========== -->
	<table id="letterhead">
		<tr>
			<td width='33%' valign='top'>
				{{-- <h3>{{ $_setup->name }}</h3> --}}
				<div class="address">
					<strong>{{ $_setup->name }}</strong></br>
					{{ $setup->address1.', '. $setup->address2 }}<br>
					{{ ($setup->address2 == '' ? '' : $setup->address2 .', ') . $setup->city .' '. $setup->state .', '. $setup->country_name->name }}</br>
					Phone: 555-555-5555
				</div>
			</td>
			<td width='34%' align='center'>
				<h2>{{ $title }}</h2>
				<div class="title">
					<strong>{{ $subTitle }}</strong></br>
					@if ($param1 <> '')
						{{ $param1 }}</br>
					@endif
					@if ($param2 <> '')
						{{ $param2 }}</br>
					@endif
					@if ($param3 <> '')
						{{ $param3 }}</br>
					@endif
				</div>	
			</td>
			<td width='33%' align='right'>
				<img src="{{ storage_path('logo.png') }}" width="90px" height="90px">
				{{-- <img src="{{ Storage::disk('s3t')->url('logo/'.$_setup->logo) }}" width="90px" height="90px"/> --}}
				{{-- <img src="{{ Storage::disk('s3t')->url('logo/'.$_setup->logo) }}" width="90px" height="90px"/> --}}
			</td>
		</tr>
	</table>
	<!-- ========== LETTERHEAD ========== -->

	<!-- <div class="invoice-header">
		<img class="logo" src="https://www.example.com/logo.png" alt="Company Logo">
		<div class="company-name">Company Name</div>
	</div> -->
	<!--   <h1>Invoice</h1> -->

	{{-- <div class="invoice-from-to">
		<div class="invoice-from">
			<p><strong>Invoice From:</strong></p>
			<p>Company Name</p>
			<p>Address</p>
			<p>City, State ZIP</p>
			<p>Phone: 555-555-5555</p>
		</div>
		<div class="invoice-to">
			<p><strong>Invoice To:</strong></p>
			<p>Customer Name</p>
			<p>Address</p>
			<p>City, State ZIP</p>
			<p>Phone: 555-555-5555</p>
		</div>
	</div> --}}

	<!-- Report main content -->
	{{-- @yield('content') --}}
	<!-- /.content -->

	<table id="info">
		<tr>
			<td valign='top' width='50%' >
				@yield('info1')
			</td>
			<td valign='top' width='50%'>
				@yield('info2')
			</td>
		</tr>
	</table>

	<br>
	<table id="data">
		@yield('data')
	</table>
	<br>

	@yield('notes')

	

</body>
</html>
