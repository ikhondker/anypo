@extends('layouts.landlord.app')
@section('title','View Ticket')
@section('breadcrumb','View Ticket')

@section('content')

<div class="d-grid gap-3 gap-lg-5">

	<!-- Card -->
	<div class="card">
		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h4 class="card-header-title text-info">#{{ $ticket->id }}: {{ $ticket->title }}</h4>
			<div class="h3"><span class="badge bg-{{ $ticket->status->badge }}"><i class="bi bi-gear"></i> {{ $ticket->status->name }}</span></div>
		</div>

		<!-- Body -->
		<div class="card-body">

			<ul class="list-comment mb-3">
				<!-- Item -->
				<li class="list-comment-item">
					<!-- Media -->
					<div class="d-flex mb-3">
						<div class="flex-shrink-0">
							<img class="avatar avatar-circle" src="{{ Storage::disk('s3l')->url('avatar/'.$ticket->owner->avatar) }}" alt="{{ $ticket->owner->name }}" title="{{ $ticket->owner->name }}">
						</div>

						<div class="flex-grow-1 ms-3">
							<h5 class="text-info">{{ $ticket->owner->name }}</h5>
							<div class="d-flex align-items-center mb-1">
								<span class="d-block small">
									Date: {{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }} <br>
									Account: {{ $ticket->owner->account->name }} <br>
									@if (auth()->user()->isSeeded())
										Department: {{ $ticket->dept->name }} | Priority: {{ $ticket->priority->name }}
										@if ($ticket->agent_id <> '')
											| Agent: <span class="badge bg-secondary">{{ $ticket->agent->name }}</span>
										@endif
									@endif
								</span>
							</div>

							<h5 class="text-muted mt-4">TICKET SUMMARY:</h5>
							<p class="text-dark">
								<hr class="text-muted" />
								{!! nl2br($ticket->content) !!}
							</p>

							@if ($ticket->attachment_id <> '')
								<p class="small text-muted">Attachment: <x-landlord.attachment.show-by-id id="{{ $ticket->attachment_id }}"/></p>
							@endif

							<hr class="text-muted" />
							@if ($ticket->closed)
								<p class="small text-muted">Closed at: {{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->closed_at ))) }} </p>
							@endif

							@if ( auth()->user()->isSeeded() && ( $ticket->status_code <> App\Enum\LandlordTicketStatusEnum::CLOSED->value) )
								<a class="btn btn-info btn-sm" href="{{ route('tickets.assign',$ticket->id) }}">
									<i class="bi bi-person-circle"></i>
									Assign
								</a>
								<a class="btn btn-info btn-sm" href="{{ route('tickets.edit',$ticket->id) }}">
									<i class="bi bi-pencil-square"></i>
									Edit
								</a>
							@endif

							@if ( $ticket->status_code <> App\Enum\LandlordTicketStatusEnum::CLOSED->value)
								<a class="btn btn-info btn-sm sw2" href="{{ route('tickets.close',$ticket->id) }}">
									<i class="bi bi-lightbulb-off"></i>
									Close Ticket
								</a>
							@endif

						</div>
					</div>
					<!-- End Media -->
				</li>
				<!-- End Item -->
			</ul>

		</div>
		<!-- End Body -->

		<!-- Footer -->
		{{-- <div class="card-footer pt-0">
			<div class="d-flex justify-content-end gap-3">
				<a class="btn btn-primary" href="{{ route('tickets.edit',$ticket->id) }}">Edit</a>
			</div>
		</div> --}}
		<!-- End Footer -->

	</div>
	<!-- End Card -->

	<!--  BEGIN ADD COMMENT  -->
	@if ( $ticket->status_code <> App\Enum\LandlordTicketStatusEnum::CLOSED->value)
		@include('landlord.includes.ticket-add-comment')
	@endif
	<!--  END ADD COMMENT  -->

	<!-- card-ticket-comments -->
	<x-landlord.widget.ticket-comments id="{{ $ticket->id }}"/>
	<!-- /.card-ticket-comments -->



</div>

@endsection


