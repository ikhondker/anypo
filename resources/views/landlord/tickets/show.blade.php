@extends('layouts.landlord.app')
@section('title','View Ticket')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-muted">Tickets</a></li>
	<li class="breadcrumb-item active">#{{ $ticket->id }}</li>
@endsection

@section('content')

		
	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				@if ( auth()->user()->isSeeded() && ( $ticket->status_code <> App\Enum\LandlordTicketStatusEnum::CLOSED->value) )
					<a href="{{ route('tickets.assign',$ticket->id) }}" class="btn btn-sm btn-light"><i class="fas fa-tasks"></i> Assign</a>
					<a href="{{ route('tickets.edit',$ticket->id) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Edit</a>
				@endif
				@if ( $ticket->status_code <> App\Enum\LandlordTicketStatusEnum::CLOSED->value)
					<a href="{{ route('tickets.close',$ticket->id) }}" class="btn btn-sm btn-light sw2"><i class="fas fa-power-off text-danger"></i> Close Ticket</a>
				@endif
				<a href="{{ route('tickets.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
			</div>
			<h5 class="card-title mb-0">#{{ $ticket->id }}: {{ $ticket->title }}</h5>
			<div class="badge bg-{{ $ticket->status->badge }} my-2">{{ $ticket->status->name }}</div>
		</div>
		<div class="card-body pt-0">
			<h5>Description</h5>
			<p class="text-muted">
				{!! nl2br($ticket->content) !!}
			</p>
			<small class="text-muted">{{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }}</small><br />
			@if ($ticket->attachment_id <> '')
				<small class="text-muted">Attachment: <x-landlord.attachment.show-by-id id="{{ $ticket->attachment_id }}"/></small><br />
			@endif
			@if ($ticket->closed)
				<small class="text-muted">Closed at: {{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->closed_at ))) }}</small><br />
			@endif


			{{-- <div>
				<h5>Requestor</h5>
				<img src="{{ Storage::disk('s3l')->url('avatar/'.$ticket->owner->avatar) }}" class="rounded-circle me-1" alt="{{ $ticket->owner->name }}" title="{{ $ticket->owner->name }}" width="34" height="34">
			</div> --}}

			<table class="table table-sm my-2">
				<tbody>
					<tr>
						<th>Requestor</th>
						<td>
							{{ $ticket->owner->name }}
						</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>{{ $ticket->owner->email }}</td>
					</tr>
					<tr>
						<th>Account</th>
						<td>{{ $ticket->owner->account->name }} </td>
					</tr>
					
					@if (auth()->user()->isSeeded())
						<tr>
							<th>Department</th>
							<td>{{ $ticket->dept->name }}</td>
						</tr>
						<tr>
							<th>Priority</th>
							<td>{{ $ticket->priority->name }}</td>
						</tr>
						<tr>
							<th>Agent</th>
							<td><span class="badge badge-subtle-success">{{ $ticket->agent->name }}</span> </td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>

	<!-- BEGIN ADD COMMENT -->
	@if ( $ticket->status_code <> App\Enum\LandlordTicketStatusEnum::CLOSED->value)
		@include('landlord.includes.ticket-add-comment')
	@endif
	<!-- END ADD COMMENT -->

	<!-- card-ticket-comments -->
	<x-landlord.widgets.ticket-comments id="{{ $ticket->id }}"/>
	<!-- /.card-ticket-comments -->

@endsection


