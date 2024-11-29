
<html lang="en">
	<head>
	<meta charset="utf-8">

	<title>@yield('title', 'Reports')</title>
	<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />
	<style type="text/css">
		/* CSS for styling the invoice */
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

		body {
			font-family: "Inter", sans-serif;
			font-size: 12px;
			/* margin-top: 2cm;
			margin-left: 2cm;
			margin-right: 2cm;
			 */
			 margin-bottom: 1cm;	/* Needed for footer */
		}
		table {
			border-collapse: collapse;
			width: 100%;
		}
		#data th, td {
			border: 1px solid silver;
			padding: 5px;
			/* Increase padding for few selected reports */
			@isset($padding)
				@if ($padding)
					padding: 10px;
				@endif
			@endisset
		}
		#data th {
			/* text-align: left; */
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

		/* Custom Added by Iqbal */

		h2, h3 {
			color: #0087C3;
			font-size: 16px;
			margin: 0;
			padding: 0;
		}
		.address {
			font-size: 12px;
			/* width: 50%; */
			margin: 0px;
			padding: 3px;
		}

		/* hr {
			border-top: 1px solid silver;
			} */

		#letterhead td, th {
			border: none;
			margin: 0;
			padding: 3px;
		}

		.title {
			text-align: center;
			font-size: 12px;
			margin: 0px;
			padding: 3px;
		}

		/* used in data tables */
		table .sl {
			text-align: center;
		}

		table .desc {
			text-align: left;
		}

		table .numeric {
			text-align: right;
		}

		/* style for footer */
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
		#footer td, th {
			/* border: none; */
			border-left: none;
			border-bottom: none;
			border-right: none;
		}

		/*
		#info td, th {
			border-top: 1px solid silver;
			border-bottom: 1px solid silver;
			border-left: none;
			border-right: none;
			margin: 0;
			padding: 0;
		}
		*/

		/*
		#info td {
			padding-left: 6px;
			border-left: 6px solid #555858;
			border-top: none;
			border-bottom: none;
			border-right: none;
		}
		*/

		#notes {
				padding-left: 6px;
				border-left: 6px solid #0087C3;
		}

	</style>
</head>
<body>
	<!-- ========== FOOTER ========== -->
	<footer>

		<table id="footer">
			<tr>
				<td width='34%' style='font-size:10px;' valign='top' >
					Printed by
						@if(Auth::check())
							{{ auth()->user()->name }}
						@else
							Guest
						@endif
						at {{ now()->format('d-M-Y H:i:s') }}
					</td>
				<td width='34%' style='font-size:10px;' align='center' valign='top'>
						Ref: {{ URL::current() }}
				</td>
				<td width='33%' style='font-size:10px;' align='right' valign='top'>
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
					{{ $setup->email }}</br>
					{{ $setup->website }}
				</div>
			</td>
			<td width='34%' align='center' valign='top'>
				<h2>{{ $title }}</h2>
				<div class="title">
					@if ($subTitle <> '')
						<strong>{{ $subTitle }}</strong> </br>
					@endif
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
				{{-- <img src="{{ storage_path('logo.png') }}" width="80px" height="80px"> --}}
				<img src="{{ Str::replace('\\','/',Storage::disk('s3t')->url('logo/'.$_setup->logo)) }}" width="80px" height="80px"/>
			</td>
		</tr>
	</table>
	<!-- ========== LETTERHEAD ========== -->
	@isset($info)
		@if ($info)
			<table id="info">
				<tr>
					<td valign='top' width='50%' >
						@yield('info1')
					</td>
					<td align='right' valign='top' width='50%'>
						@yield('info2')
					</td>
				</tr>
			</table>
			<br>
		@endif
	@endisset

	<table id="data">
		<!-- Report main content -->
		@yield('data')
		<!-- ./Report main content -->
	</table>
	<br>

	<div id="notes">
		<!-- Notes -->
		@yield('notes')
		<!-- ./Notes -->
	</div>
</body>
</html>
