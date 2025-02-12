
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
							<i data-lucide="plus"></i> Create Ticket</a>
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>Ticket#</th>
						<th>Subject</th>
						<th>Requestor</th>
						<th>Date</th>
						@if ( auth()->user()->isBackend())
							<th>Dept</th>
							<th>Agent</th>
						@endif
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tickets as $ticket)
						<tr>
							<td>
								<a class="text-muted" href="{{ route('tickets.show',$ticket->id) }}">
									@if ( $ticket->status_code <> App\Enum\Landlord\TicketStatusEnum::CLOSED->value)
										<i data-lucide="clock" class="text-warning"></i>
									@else
										<i data-lucide="check-circle" class="text-muted"></i>
									@endif
									<strong>{{ $ticket->id }}</strong>
								</a>
							</td>
							<td>
								<a class="" href="{{ route('tickets.show', $ticket->id) }}">
									<strong class="text-muted mb-0">{{ Str::limit($ticket->title, 45) }}</strong>
								</a>
							</td>
							<td>
								<img src="{{ Storage::disk('s3l')->url('avatar/'.$ticket->owner->avatar) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $ticket->owner->name }}" title="{{ $ticket->owner->name }}">
								{{ $ticket->owner->name }}
							</td>
							<td>{{ strtoupper(date('d-M-Y', strtotime($ticket->ticket_date ))) }}</td>
							@if ( auth()->user()->isBackend())
								<td>{{ $ticket->dept->name }}</td>
								<td>{{ $ticket->agent->name }}</td>
							@endif
							<td>
								<x-landlord.list.my-badge value="{{ $ticket->status->name }}" badge="{{ $ticket->status->badge }}"/>
							</td>
							<td>
								<a href="{{ route('tickets.show',$ticket->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
								@if ( auth()->user()->isBackend())
                                <a href="{{ route('tickets.assign',$ticket->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Assign"><i data-lucide="user-check" class="text-danger"></i> Assign</a>
								@endif
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
