<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
						<img src="{{ asset('flow/pol.jpg')}}" width="240" height="321" class="mt-2" alt="Po">
					</div>
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<h4>PO #{{ $pol->po->id }} {{ $pol->po->summary }}</h4>
						<p>{{ $pol->notes }}</p>
						<table class="table table-sm my-2">
					
							<tbody>
								<tr>
									<th>Line #</th>
									<td>{{ $pol->line_num }}</td>
								</tr>
								<tr>
									<th>Item</th>
									<td>{{ $pol->summary }}</td>
								</tr>
								<tr>
									<th>Ord Qty</th>
									<td>{{ number_format($pol->qty,2) }}</td>
								</tr>
								<tr>
									<th>Rcv Qty</th>
									<td>{{ number_format($pol->received_qty,2) }}</td>
								</tr>
								<tr>
									<th>Unit Price</th>
									<td>{{ number_format($pol->price , 2) }} {{ $pol->currency }}</td>
								</tr>
								
								<tr>
									<th>Line Amount</th>
									<td>{{ number_format($pol->amount , 2) }} {{ $pol->currency }}</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><a href="{{ route('pols.show',$pol->id) }}" class="text-warning d-inline-block">View Purchase Order Line ...</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>