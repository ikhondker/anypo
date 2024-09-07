		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
						<a class="btn btn-sm btn-light" href="{{ route('prs.edit', $pr->id ) }}"><i class="fas fa-edit"></i> Edit</a>
					@endif
					
					{{-- <a class="btn btn-sm btn-light" href="{{ route('prs.index') }}" ><i class="fas fa-list"></i> View all</a> --}}
				</div>
				<h5 class="card-title mb-0">[PR#{{ $pr->id }}] {{ $pr->summary }}</h5>
			</div>

			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
						<img src="{{ Storage::disk('s3t')->url('flow/pr.jpg') }}" width="240" height="321" class="mt-2" alt="Pr">
					</div>
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<strong>{{ $pr->summary }}</strong>
						<p>{!! nl2br($pr->notes) !!}</p>

						<table class="table table-sm my-2">
					
							<tbody>
								<tr>
									<th>Amount</th>
									<td>{{ number_format($pr->amount , 2) }} {{ $pr->currency }}</td>
								</tr>
								<tr>
									<th>Date</th>
									<td>
										{{ ($pr->pr_date <> "") ? strtoupper(date('d-M-y', strtotime($pr->pr_date))) : "" }}
									</td>
								</tr>
								<tr>
									<th>Auth Status</th>
									<td><span class="badge {{ $pr->auth_status_badge->badge }}">{{ $pr->auth_status_badge->name}}</span></td>
								</tr>
								<tr>
									<th>Status</th>
									<td><span class="badge {{ $pr->status_badge->badge }}">{{ $pr->status_badge->name}}</span></td>
								</tr>
								<tr>
									<th>Supplier</th>
									<td>{{ $pr->supplier->name }}</td>
								</tr>
								<tr>
									<th>Requestor</th>
									<td>{{ $pr->requestor->name }}</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><a href="{{ route('prs.show',$pr->id) }}" class="text-warning d-inline-block">View Requisition ...</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	