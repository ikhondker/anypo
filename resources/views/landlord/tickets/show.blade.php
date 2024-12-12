@extends('layouts.landlord.app')
@section('title','View Ticket')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-muted">Tickets</a></li>
	<li class="breadcrumb-item active">#{{ $ticket->id }}</li>
@endsection

@section('content')

	<x-landlord.page-header>
		@slot('title')
			Ticket #{{ $ticket->id }}
		@endslot
		@slot('buttons')
				@if (auth()->user()->isBackend())
					<x-landlord.actions.ticket-actions ticketId="{{ $ticket->id }}"/>
				@endif
				<a href="{{ route('tickets.create') }}" class="btn btn-primary float-end me-1"><i data-lucide="plus"></i> New Ticket</a>
				<a href="{{ route('tickets.index') }}" class="btn btn-primary float-end me-1"><i data-lucide="database"></i> View all</a>
				<a href="{{ route('reports.pdf-ticket', $ticket->id) }}" class="btn btn-primary float-end me-1"><i data-lucide="printer"></i> Print</a>
		@endslot
	</x-landlord.page-header>

	<!-- card-ticket-header -->
	<x-landlord.widgets.ticket-header ticketId="{{ $ticket->id }}"/>
	<!-- /.card-ticket-header -->

	@if (auth()->user()->isBackend())
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
				</div>
				<h5 class="card-title text-danger mb-0">Support Details</h5>
			</div>
			<div class="card-body pt-0">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Category :</th>
							<td><span class="badge badge-subtle-success">{{ $ticket->category->name }}</span> </td>
						</tr>
						<tr>
							<th>Department :</th>
							<td><span class="badge badge-subtle-success">{{ $ticket->dept->name }}</span> </td>
						</tr>
						<tr>
							<th>Priority :</th>
							<td><span class="badge badge-subtle-success">{{ $ticket->priority->name }}</span> </td>
						</tr>
						<tr>
							<th>Agent :</th>
							<td><span class="badge badge-subtle-success">{{ $ticket->agent->name }}</span> </td>
						</tr>
						<tr>
							<th>First Response At :</th>
							<td>{{ ($ticket->first_response_at == null) ? null : Carbon\Carbon::parse($ticket->first_response_at)->ago() }}</td>
						</tr>
						<tr>
							<th>Last Message At :</th>
							<td>{{ ($ticket->last_message_at == null) ? null : Carbon\Carbon::parse($ticket->last_message_at)->ago() }}</td>
						</tr>
						<tr>
							<th>Last Response At :</th>
							<td>{{ ($ticket->last_response_at == null) ? null : Carbon\Carbon::parse($ticket->last_response_at)->ago() }}</td>
						</tr>
						<tr>
							<th>Closed At :</th>
							<td>{{ ($ticket->closed_at == null) ? null : Carbon\Carbon::parse($ticket->closed_at)->ago() }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	@endif


	<!-- BEGIN ADD COMMENT -->
	@if ( $ticket->status_code <> App\Enum\Landlord\TicketStatusEnum::CLOSED->value)
		@include('landlord.includes.ticket-add-comment')
	@endif
	<!-- END ADD COMMENT -->

	<!-- card-ticket-comments -->
	<x-landlord.widgets.ticket-comments id="{{ $ticket->id }}"/>
	<!-- /.card-ticket-comments -->

@endsection


