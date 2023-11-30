
	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">{{ $title }}</h5>
			<a class="btn btn-primary btn-sm" href="{{ route('tickets.create') }}">
				<i class="bi bi-plus-square me-1"></i> Create Ticket
			</a>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
				<tr>
					<th>&nbsp; &nbsp; Subject</th>
					<th>Priority</th>
					<th>Status</th>
					<th style="width: 5%;">Action</th>
				</tr>
				</thead>

				<tbody>
					@foreach ($tickets as $ticket)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle" src="{{ url(config('bo.DIR_AVATAR').$ticket->owner->avatar) }}"  alt="{{ $ticket->owner->name }}" title="{{ $ticket->owner->name }}">
									</div>
									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="{{ route('tickets.show',$ticket->id) }}">
											
											@if ( $ticket->status_code->value <>  App\Enum\LandlordTicketStatusEnum::CLOSED->value) 
												<h6 class="text-info mb-0">
											@else 
												<h6 class="text-secondary mb-0">
											@endif 
													[#{{ $ticket->id }}] {{ Str::limit($ticket->title, 45) }}
												</h6>
										</a>
										<small class="d-block"> {{ $ticket->owner->name }} [{{ strtoupper(date('d-M-Y', strtotime($ticket->ticket_date ))) }}]  | {{ $ticket->dept->name }} </small>
									</div>
								</div>

								{{-- <div class="flex-grow-1 ms-3">
									<a class="d-inline-block link-dark" href="{{ route('tickets.show',$ticket->id) }}">
										<h6 class="text-hover-primary mb-0">[#{{ $ticket->id }}] {{ Str::limit($ticket->title, 45) }}</h6>
									</a>
									<small class="d-block">{{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }}</small>
								</div> --}}
							</td>
							<td><x-landlord.list.my-badge :value="$ticket->priority->name" badge="{{ $ticket->priority->badge }}"/></td>
							<td><x-landlord.list.my-badge value="{{ $ticket->status->name }}" badge="{{ $ticket->status->badge }}"/></td>
							<td>
								<a href="{{ route('tickets.show',$ticket->id) }}" class="text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
									<i class="bi bi-eye" style="font-size: 1.3rem;"></i>
								</a>

								{{-- <x-landlord.list.actions object="Ticket" :id="$ticket->id"/> --}}
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
		<!-- End Table -->

		{{-- <!-- card-body -->
		<div class="card-body">
			<!-- pagination -->
			{{ $tickets->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body --> --}}

	</div>
	<!-- End Card -->

	{{-- <!-- card-notifications -->
	<div class="card mt-2 col-12">
		<x-landlord.card.header title="Notifications" />
		<div class="card-body pt-1">
			<x-landlord.wf.notification-unread />
		</div>
	</div>
	<!-- /.card-notifications --> --}}
