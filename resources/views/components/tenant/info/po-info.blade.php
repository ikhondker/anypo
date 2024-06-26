<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-3 col-xxl-3 text-center">
						<img src="{{ Storage::disk('s3t')->url($photo) }}" width="240" height="320" class="mt-2" alt="PO">
						{{-- <img src="{{ asset('flow/po.jpg')}}" width="240" height="320" class="mt-2" alt="Po"> --}}
						{{-- <img src="{{ asset('flow/po.jpg')}}" width="240" height="320" class="mt-2" alt="Po"> --}}

					</div>
					<div class="col-sm-9 col-xl-9 col-xxl-9">
						<h4>PO #{{ $po->id }} : {{ $po->summary }}</h4>
						<p>{!! nl2br($po->notes) !!}</p>
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
									<th>Department</th>
									<td>{{ $po->dept->name }}</td>
								</tr>
								<tr>
									<th>Project</th>
									<td>{{ $po->project->name }}</td>
								</tr>
								<tr>
									<th>Auth Status</th>
									<td><span class="badge {{ $po->auth_status_badge->badge }}">{{ $po->auth_status_badge->name}}</span></td>
								</tr>
								<tr>
									<th>Closure Status</th>
									<td><span class="badge {{ $po->status_badge->badge }}">{{ $po->status_badge->name}}</span></td>
								</tr>
								<tr>
									<th>Buyer</th>
									<td>{{ $po->buyer->name }}</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><a href="{{ route('pos.show',$po->id) }}" class="text-warning d-inline-block">View Purchase Order ...</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
