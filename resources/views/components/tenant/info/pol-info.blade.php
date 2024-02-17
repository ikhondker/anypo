<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
						<img src="{{ asset('/img3.jpg')}}" width="180" height="180" class="mt-2" alt="Project">
					</div>
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<h4>PO #{{ $pol->id }} {{ $pol->summary }}</h4>
						<p>{{ $pol->notes }}</p>
						<table class="table table-sm my-2">
					
                            <tbody>
								<tr>
									<th>Amount</th>
                                    <td>{{ number_format($pol->amount , 2) }} {{ $pol->currency }}</td>
								</tr>
                                <tr>
									<th>Date</th>
									<td>
										{{ ($pol->po_date <> "") ? strtoupper(date('d-M-y', strtotime($pol->po_date))) : "" }}
									</td>
								</tr>
                                <tr>
									<th>Auth Status</th>
                                    <td><span class="badge {{ $pol->closure_status_badge->badge }}">{{ $pol->closure_status_badge->name}}</span></td>
								</tr>
								
                                <tr>
									<th>Item</th>
                                    <td>{{ $pol->item_id  }}</td>
								</tr>
								<tr>
									<th>Qty</th>
                                    <td>{{ $pol->qty_id  }}</td>
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