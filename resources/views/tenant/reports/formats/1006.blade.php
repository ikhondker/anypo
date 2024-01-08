<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		{{-- <link rel="stylesheet" href="style.css" media="all" /> --}}
		<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />

	<!-- ========== STYLE ========== -->
	@include('tenant.reports.single-page-css')
	<!-- ========== STYLE ========== -->

	</head>
	<body>
		<!-- ========== STYLE ========== -->
		@include('tenant.reports.parts.footer')
		<!-- ========== STYLE ========== -->
		
		<!-- ========== STYLE ========== -->
		@include('tenant.reports.parts.landscape-letterhead')
		<!-- ========== STYLE ========== -->
		<main>
			<table border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="desc">#</th>
						<th class="desc">PR#</th>
						<th class="desc">DESCRIPTION</th>
						<th class="desc">UOM</th>
						<th class="unit">UNIT PRICE</th>
						<th class="qty">QUANTITY</th>
						<th class="total">AMOUNT( {{ $pr->currency }})</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($prls as $prl)
					<tr>
						<td class="desc">{{ $loop->iteration }}</td>
						<td class="desc">{{ $pr->id }}</td>
						<td class="desc">{{ $prl->summary }}</td>
						<td class="desc"> {{  $prl->item->uom->name }} </td>
						<td class="unit">${{ number_format($prl->amount,2) }}</td>
						<td class="qty">{{ $prl->qty }}</td>
						<td class="total">{{ number_format($prl->amount,2) }}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="5"></td>
						<td colspan="1">GRAND TOTAL</td>
						<td> {{ $pr->currency }} {{ number_format($pr->amount,2) }}</td>
					</tr>
				</tfoot>
			</table>
			<!-- ========== STYLE ========== -->
			{{-- @include('tenant.reports.parts.thankyou') --}}
			<!-- ========== STYLE ========== -->
			
		</main>
		
	</body>
</html>