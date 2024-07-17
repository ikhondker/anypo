
	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<h5 class="card-title"> {{ $title }}</h5>
				</div>
				<div class="col-md-6 col-xl-8">
					<div class="text-sm-end">
						<a href="{{ route('tickets.create') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Create Ticket</a>
					</div>
				</div>
			</div>

			<table id="datatables-orders" class="table w-100">
				<thead>
					<tr>
						<th class="align-middle">#</th>
						<th class="align-middle">Subject</th>
						<th class="align-middle">Requestor</th>
						<th class="align-middle">Date</th>
						@if ( auth()->user()->isSeeded())
							<th class="align-middle">Dept</th>
							<th class="align-middle">Agent</th>
						@endif
						<th class="align-middle">Status</th>
						<th class="align-middle text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tickets as $ticket)
						<tr>
							<td>
								<a class="text-info" href="{{ route('tickets.show',$ticket->id) }}">
									#{{ $ticket->id }}
								</a>
							</td>
							<td>
								<a class="" href="{{ route('tickets.show',$ticket->id) }}">
									@if ( $ticket->status_code <> App\Enum\LandlordTicketStatusEnum::CLOSED->value)
										<strong class="text-info mb-0">
									@else
										<strong class="text-secondary mb-0">
									@endif
										{{ Str::limit($ticket->title, 45) }}
										</strong>
								</a>
							</td>
							<td>
								<img src="{{ Storage::disk('s3l')->url('avatar/'.$ticket->owner->avatar) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $ticket->owner->name }}" title="{{ $ticket->owner->name }}">
								{{ $ticket->owner->name }}
							</td>
							<td>{{ strtoupper(date('d-M-Y', strtotime($ticket->ticket_date ))) }} </td>
							@if ( auth()->user()->isSeeded())
								<td>{{ $ticket->dept->name }}</td>
								<td>{{ $ticket->agent->name }}</td>
							@endif
							<td>
								<x-landlord.list.my-badge value="{{ $ticket->status->name }}" badge="{{ $ticket->status->badge }}"/>
							</td>
							<td class="text-end">
								<a href="{{ route('tickets.show',$ticket->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View">View</a>
								@if ( auth()->user()->isSeeded())
									<a href="{{ route('tickets.assign',$ticket->id) }}" class="me-2"
										data-bs-toggle="tooltip" data-bs-placement="top" title="Assign">
										<i data-lucide="check-circle" class="text-danger"></i>
								@endif
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
