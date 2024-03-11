@extends('layouts.landlord-app')
@section('title','View Ticket')
@section('breadcrumb','View Ticket')

@section('content')



<div class="d-grid gap-3 gap-lg-5">

	<!-- Card -->
	<div class="card">
		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h4 class="card-header-title">#{{ $ticket->id }}: {{ $ticket->title }}</h4>
			<div class="h4"><span class="badge bg-{{ $ticket->status->badge }}">{{ $ticket->status->name }}</span></div>
		</div>

		<!-- Body -->
		<div class="card-body">

			{{-- <p class="small text-muted">{{ $ticket->owner->name }}</small><small class="text-muted"> on : {{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }}</p> --}}
			{{-- <x-landlord.show.my-badge value="{{ $ticket->status->name }}" label="Status" badge="{{ $ticket->status->badge }}"/> --}}
			{{-- <x-landlord.show.my-badge value="{{ $ticket->priority->name }}" label="Priority" badge="{{ $ticket->priority->badge }}"/>
			<x-landlord.show.my-badge value="{{ $ticket->dept->name }}" label="Dept"/> --}}
			{{-- <x-landlord.show.my-text  value="{{ $ticket->owner->name  }}" label="Owner"/> --}}

			<ul class="list-comment mb-7">
				<!-- Item -->
				<li class="list-comment-item">
					<!-- Media -->
					<div class="d-flex mb-3">
						<div class="flex-shrink-0">
							<img class="avatar avatar-circle" src="{{ Storage::disk('s3la')->url($ticket->owner->avatar) }}" alt="{{ $ticket->owner->name }}" title="{{ $ticket->owner->name }}">
						</div>

						<div class="flex-grow-1 ms-3">
							<h5>{{ $ticket->owner->name }}</h5>
							<div class="d-flex align-items-center mb-3">
								<span class="d-block small">{{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }} | Department: {{ $ticket->dept->name }} | Priority: {{ $ticket->priority->name }}</span>
								{{-- <small class="d-block">on November 12, 2020</small> --}}
							</div>

							{{-- <h5>Fun place to work at</h5> --}}
							<p class="text-dark pt-4">{{ $ticket->content }}</p>
							
							@if ($ticket->attachment_id <> '')
								<p class="small text-muted">Attachment: <x-landlord.attachment.show-by-id id="{{ $ticket->attachment_id }}"/></p>
							@endif
							@if ( auth()->user()->isBackOffice() && ( $ticket->agent_id <> ''))
								<p class="small text-danger">Assignee: {{ $ticket->agent->name  }}</p>
							@endif
							

							@if ( auth()->user()->isBackOffice() && ( $ticket->status_code <>  App\Enum\LandlordTicketStatusEnum::CLOSED->value) )
								<a class="btn btn-info btn-sm" href="{{ route('tickets.assign',$ticket->id) }}">
									<i class="bi bi-person-circle"></i>
									Assign
								</a>
								<a class="btn btn-info btn-sm" href="{{ route('tickets.edit',$ticket->id) }}">
									<i class="bi bi-pencil-square"></i>
									Edit
								</a>
							@endif

							@if ( $ticket->status_code <>  App\Enum\LandlordTicketStatusEnum::CLOSED->value) 
								<a class="btn btn-info btn-sm sweet-alert2-confirm" href="{{ route('tickets.close',$ticket->id) }}">
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
	{{-- TODO not for closed ticket --}}
	@if ( $ticket->status_code <>  App\Enum\LandlordTicketStatusEnum::CLOSED->value) 
		@include('landlord.includes.ticket-add-comment')
	@endif 
	<!--  END ADD COMMENT  -->

	
	<!-- card-ticket-comments -->
	<x-landlord.widget.ticket-comments id="{{ $ticket->id }}"/>
	<!-- /.card-ticket-comments -->

	@include('landlord.includes.sweet-alert2-confirm')
	
</div>

@endsection


