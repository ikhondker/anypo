<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
						<img src="{{ asset('/img3.jpg')}}" width="180" height="180" class="mt-2" alt="Project">
					</div>
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<h4>PR #{{ $po->id }} {{ $po->summary }}</h4>
						<p>{{ $po->notes }}</p>
						<table class="table table-sm my-2">
					
                            <tbody>
								<tr>
									<th>Amount</th>
                                    <td>{{ number_format($po->amount , 2) }} {{ $po->currency }}</td>
								</tr>
                                <tr>
									<th>Date</th>
									<td>
										{{ ($po->po_date <> "") ? strtoupper(date('d-M-y', strtotime($po->po_date))) : "" }}
									</td>
								</tr>
                                <tr>
									<th>Auth Status</th>
                                    <td><span class="badge {{ $po->auth_status_badge->badge }}">{{ $po->auth_status_badge->name}}</span></td>
								</tr>
								<tr>
									<th>Status</th>
                                    <td><span class="badge {{ $po->status_badge->badge }}">{{ $po->status_badge->name}}</span></td>
								</tr>
                                <tr>
									<th>Requestor</th>
                                    <td>{{ $po->requestor->name  }}</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><a href="{{ route('prs.show',$po->id) }}" class="text-warning d-inline-block">View Requisition ...</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>