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

			* {
				/* Change your font family */
				font-family: Arial, Helvetica, sans-serif;
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
				padding: 0px;	/* 10 */
				margin-bottom: 7px; /* 20px */
				/* border-bottom: 1px solid #AAAAAA; */
			}

			#logo {
				float: left;
				margin-top: 0px;
			}

			#logo img {
				height: 60px;
				margin: 0 auto;
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

			h2.report_name {
				font-size: 1.7em;
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
			/* =============== Table ===================== */
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
				/* font-weight: normal; */
				background-color: #0087C3;
				color: #ffffff;
				text-align: left;
				font-weight: bold;
			}

			xxtable td {
				/* text-align: right; */
			}

			xxtable td h3 {
				color: #57B223;
				font-size: 1.2em;
				font-weight: normal;
				margin: 0 0 0.2em 0;
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

			table tfoot td {
				text-align: right;
				padding: 10px 10px;
				/* background: #FFFFFF; */
				border-left: none;
				border-right: none;
				border-bottom: none;
				font-size: 1em;
				white-space: nowrap;
				/* border-top: 1px solid #AAAAAA; */
			}

			xxtable tfoot tr:first-child td {
				border-top: none;
			}

			table tfoot tr:last-child td {
				color: #0087C3; /* Changed #57B223; */
				font-size: 1.4em;
				border-top: 1px solid #0087C3; /* Changed #57B223; */
			}

			xxtable tfoot tr td:first-child {
				border: none;
			}
			/* =============== / Table ===================== */

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

			.sub_title {
				font-size: 1em;
				margin: 5px 0 0 0;
			}

			.param { margin: 5px 0 0 0; }


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
				{{-- <img src="{{ storage_path('logo.png') }}"> --}}
				<img src="{{ Storage::disk('s3t')->url('logo/'.$_setup->logo) }}" width="90px" height="90px"/>
				<img src="{{ Storage::disk('s3t')->url('logo/'.$_setup->logo) }}" width="90px" height="90px"/>

				{{-- <img src="{{ asset('logo/aa.png') }}"> --}}
				<h2 class="name">{{ $_setup->name }}</h2>
				<div>{{ $setup->address1.', '. $setup->address2 }}</div>
				<div>{{ ($setup->address2 == '' ? '' : $setup->address2 .', ') . $setup->city .' '. $setup->state .', '. $setup->country_name->name }}</div>
				{{-- <h1>REQUISITION #{{ $pr->id}}</h1> --}}
				{{-- <h2 class="name">{{ env('APP_NAME')}}</h2> --}}
			</div>
			<div id="company">
				<h2 class="report_name">{{ $title }}</h2>
				<div class="sub_title">{{ $subTitle }}</div>
				@if ($param1 <> '')
					<div class="param">{{ $param1 }}</div>
				@endif
				@if ($param2 <> '')
					<div class="param">{{ $param2 }}</div>
				@endif
				@if ($param3 <> '')
					<div class="param">{{ $param3 }}</div>
				@endif

				{{-- <div>
					<p class="param">{{ $param1 }}</p>
					<p class="param">{{ $param2 }}</p>
					<p class="param">{{ $param3 }}</p>
				</div> --}}
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
