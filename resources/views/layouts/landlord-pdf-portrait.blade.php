<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>@yield('title', 'Reports')</title>
		{{-- <link rel="stylesheet" href="style.css" media="all" /> --}}

		<!-- ========== STYLE ========== -->
		<style>
			/* @font-face {
				font-family: SourceSansPro;
				src: url(SourceSansPro-Regular.ttf);
			} */
		
			@font-face {
				font-family: 'Lato';
				font-weight: normal;
				font-style: normal;
				font-variant: normal;
				/* src: url("fonts/lato/Lato-Regular.ttf") format('truetype'); */
				src: url({{storage_path().'/fonts/lato/Lato-Regular.ttf'}}) format("truetype");
			}
		
			.clearfix:after {
				content: "";
				display: table;
				clear: both;
			}
		
			a {
				color: #0087C3;
				text-decoration: none;
			}
		
			body {
				position: relative;
				/* width: 21cm;
				height: 29.7cm;
				margin: 0 auto;  */
				color: #555555;
				background: #FFFFFF;
				font-family: Lato;
				/* font-family: Arial, sans-serif; */
				font-size: 14px;
			}
		
			header {
				padding: 10px 0;
				margin-bottom: 20px;
				border-bottom: 1px solid #AAAAAA;
			}
		
			#logo {
				float: left;
				margin-top: 8px;
			}
		
			#logo img {
				height: 90px;
			}
		
			#company {
				float: right;
				text-align: right;
			}
		
		
			#details {
				margin-bottom: 50px;
			}
		
			#client {
				padding-left: 6px;
				border-left: 6px solid #0087C3;
				float: left;
			}
		
			#client .to {
				color: #777777;
			}
		
			h2.name {
				font-size: 1.4em;
				font-weight: normal;
				margin: 0;
			}
		
			#invoice {
				float: right;
				text-align: right;
			}
		
			#invoice h1 {
				color: #0087C3;
				font-size: 2em;
				line-height: 1em;
				font-weight: normal;
				margin: 0 0 10px 0;
			}
		
			#invoice .date {
				font-size: 1.1em;
				color: #777777;
			}
		
			table {
				width: 100%;
				border-collapse: collapse;
				border-spacing: 0;
				margin-bottom: 20px;
			}
		
			table th,
			table td {
				padding: 20px;
				background: #EEEEEE;
				text-align: center;
				border-bottom: 1px solid #FFFFFF;
			}
		
			table th {
				white-space: nowrap;
				font-weight: normal;
			}
		
			table td {
				text-align: right;
			}
		
			table td h3 {
				/* color: #1F9BCF;  */
				font-size: 1.2em;
				font-weight: normal;
				margin: 0 0 0.2em 0;
			}
		
			table .no {
				/* color: #FFFFFF; */
				font-size: 1.2em;
				/* background: #57B223; */
			}
		
			table .desc {
				text-align: left;
			}
		
			table .unit {
				background: #DDDDDD;
			}
		
			table .qty {}
		
			table .total {
				background: #1F9BCF;
				color: #FFFFFF;
			}
		
			table td.unit,
			table td.qty,
			table td.total {
				font-size: 1.2em;
			}
		
			table tbody tr:last-child td {
				border: none;
			}
		
			table tfoot td {
				padding: 10px 20px;
				background: #FFFFFF;
				border-bottom: none;
				font-size: 1.2em;
				white-space: nowrap;
				border-top: 1px solid #AAAAAA;
			}
		
			table tfoot tr:first-child td {
				border-top: none;
			}
		
			table tfoot tr:last-child td {
				color: #1F9BCF;
				font-size: 1.4em;
				border-top: 1px solid #1F9BCF;
		
			}
		
			table tfoot tr td:first-child {
				border: none;
			}
		
			#thanks {
				font-size: 2em;
				margin-bottom: 50px;
			}
		
			#notices {
				padding-left: 6px;
				border-left: 6px solid #0087C3;
			}
		
			#notices .notice {
				font-size: 1.2em;
			}
		
			footer {
				color: #777777;
				width: 100%;
				height: 30px;
				position: absolute;
				bottom: 0;
				border-top: 1px solid #AAAAAA;
				padding: 8px 0;
				text-align: center;
			}
		</style>
		<!-- ========== STYLE ========== -->
	</head>
	<body>

		<!-- ========== letterhead ========== -->
		<header class="clearfix">
			<div id="logo">
				<img src="{{ storage_path('app/logo/logo.png') }}">
			</div>
			<div id="company">
				<h2 class="name">{{ env('APP_NAME')}}</h2>
				<div>{{ $setup->address1.', '. $setup->address2 }}</div>
				<div>{{ $setup->city.', '.$setup->state.', '.$setup->zip. ', '.$setup->country  }}</div>
				<div>{{ $setup->cell }}</div>	
				<div>{{ $setup->email }}</div>	
				{{-- <div>{{ $setup->website }}</div> --}}
				{{-- <div>(602) 519-0450</div>
				<div>company@example1.com</div> --}}
			</div>
		</header>
		<!-- ========== letterhead ========== -->


		<main>

			<!-- Report header content -->
			@yield('header')
			<!-- /.content -->

		
			<!-- Report main content -->
			@yield('content')
			<!-- /.content -->


			<!-- ========== thankyou ========== -->
			<div id="thanks">Thank you!</div>
			<div id="notices">
				<div>NOTICE:</div>
				<div class="notice">Invoice was created on a computer and is valid without the signature and seal.</div>
			</div>
			<!-- ========== thankyou ========== -->
			
		</main>

		<!-- ========== footer ========== -->
		<footer>
			Printed at {{ strtoupper(date('d-M-Y: h:i:s')) }} by {{ auth()->user()->name}}
		</footer>
		<!-- ========== footer ========== -->

	</body>
</html>