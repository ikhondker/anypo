<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>@yield('title', 'Reports')</title>
		{{-- <link rel="stylesheet" href="style.css" media="all" /> --}}
		<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />

		<style>
			@font-face {
				font-family: 'Lato';
				font-weight: normal;
				font-style: normal;
				font-variant: normal;
				/* src: url("fonts/lato/Lato-Regular.ttf") format('truetype'); */
				/* src: url({{ storage_path() . '/fonts/lato/Lato-Regular.ttf' }}) format("truetype"); */
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
				/* commented
				width: 21cm;
				height: 29.7cm; */
				margin: 0 auto;
				color: #555555;
				background: #FFFFFF;
				font-family: Arial, sans-serif;
				font-size: 14px;
				font-family: Lato;	/* Changed */
			}
		
			header {
				padding: 10px 0;
				margin-bottom: 7px; /* 20px */
				border-bottom: 1px solid #AAAAAA;
			}
		
			#logo {
				float: left;
				margin-top: 8px;
			}
		
			#logo img {
				height: 70px;
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
				margin: 0 0 3px 0; /* margin: 0 0 10px 0; */
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
				padding: 10px; /* changed */
				/* background: #EEEEEE; */
				text-align: center;
				border: 1px solid #cccccc;	/* was border-bottom */
			}
		
			table th {
				white-space: nowrap;
				font-weight: normal;
			}
		
			table td {
				/* text-align: right; */
			}
		
			table td h3 {
				color: #57B223;
				font-size: 1.2em;
				font-weight: normal;
				margin: 0 0 0.2em 0;
			}
		
			table .no {
				color: #FFFFFF;
				font-size: 1.6em;
				background: #57B223;
			}

			table .sl {
				text-align: center;
			}

			table .desc {
				text-align: left;
			}
		
			table .unit {
				background: #DDDDDD;
			}
		
			table .qty {
				text-align: right;
			}
		
			table .total {
				background: #0087C3; /* Changed #57B223; */
				color: #FFFFFF;
			}
		
			table td.unit,
			table td.qty,
			table td.total {
				/* font-size: 1.2em; */
			}
		
			/* table tbody tr:last-child td {
				border: none;
			} */
		
			table tfoot td {
				text-align: right;
				padding: 10px 10px;
				background: #FFFFFF;
				border-left: none;
				border-right: none;
				border-bottom: none;
				font-size: 1em;
				white-space: nowrap;
				border-top: 1px solid #AAAAAA;
			}
		
			table tfoot tr:first-child td {
				border-top: none;
			}
		
			table tfoot tr:last-child td {
				color: #0087C3; /* Changed #57B223; */
				font-size: 1.4em;
				border-top: 1px solid #0087C3; /* Changed #57B223; */
		
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
				height: 20px; /* 30px */
				/* commented position: absolute; */
				position: fixed;
				bottom: 0;
				font-size: .8em; /* added */
				border-top: 1px solid #AAAAAA;
				padding: 8px 0;	/* 8px 0 */
				text-align: center;
			}
		
			/* custom */
			#pagenum {
				float: right;
				text-align: right;
		
			}
			#timestamp {
				float: left;
			}
			.pagenum:before {
				content: counter(page);
			}
		</style>
	</head>
	<body>
		<!-- ========== FOOTER ========== -->
		<footer class="clearfix">
			<div id="timestamp">
				Printed at: {{ now()->format('d-M-Y H:i:s') }} by
					@if(Auth::check())
						{{ auth()->user()->name }}
					@else
						Guest
					@endif
					from: {{ URL::current() }}
			</div>
			<div id="pagenum">
				Page <span class="pagenum"></span>
			</div>
		</footer>
		<!-- ========== FOOTER ========== -->
		
		<!-- ========== LETTERHEAD ========== -->
		<header class="clearfix">
			<div id="logo">
				<img src="{{ storage_path('logo.png') }}">
				<h2 class="name">{{ $_setup->name }}</h2>
				{{-- <div>{{ $setup->address1.', '. $setup->address2 }}</div> --}}
				{{-- <h1>REQUISITION #{{ $pr->id}}</h1> --}}
				{{-- <h2 class="name">{{ env('APP_NAME')}}</h2> --}}
			</div>
			<div id="company">
				<h2 class="name">{{ $report->name }}</h2>
				<div>Functional Currency: {{ $_setup->currency }}</div>
				@if ($param1 <> '')
					<div>{{ $param1 }}</div>
				@endif
				@if ($param2 <> '')
					<div>{{ $param2 }}</div>
				@endif
				{{-- <div><small>Report Date {{ strtoupper(date('d-M-Y H:i:s', strtotime(now()))) }}<small></div> --}}
				{{-- <div>{{ $setup->cell }} {{ $setup->email }}</div>	 --}}
				{{-- <div>{{ $setup->email }}</div>	 --}}
				{{-- <div>{{ $setup->website }}</div> --}}
				{{-- <div>(602) 519-0450</div>
				<div>company@example1.com</div> --}}
			</div>
			</div>
		</header>
		<!-- ========== LETTERHEAD ========== -->

		<main>

			<!-- Report main content -->
				@yield('content')
			<!-- /.content -->
			<!-- ========== STYLE ========== -->
			{{-- @include('tenant.reports.parts.thankyou') --}}
			<!-- ========== STYLE ========== -->
		</main>
		
	</body>
</html>