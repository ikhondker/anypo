@extends('layouts.landlord.app')
@section('title','Ticket Assignment')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-muted">Tickets</a></li>
	<li class="breadcrumb-item active">#{{ $ticket->id }}</li>
@endsection




@section('content')

	<a href="{{ route('tickets.index') }}" class="btn btn-primary float-end mt-n1 "><i data-lucide="database"></i> View All</a>
	<h1 class="h3 mb-3">Assign Ticket</h1>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('tickets.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i>View all</a>
			</div>

			<h5 class="card-title">Assign Ticket #{{ $ticket->id }}</h5>
			<h6 class="card-subtitle text-muted">Assign Support Ticket</h6>
		</div>
		<div class="card-body">

			<form action="{{ route('tickets.do-assign', $ticket->id) }}" method="POST">
				@csrf
				<table class="table table-sm my-2">
					<tbody>

						<x-landlord.edit.agent		value="{{ $ticket->agent_id }}"/>
						<x-landlord.show.my-text	value="{{ $ticket->title }}" label="Title"/>
						<x-landlord.show.my-text	value="{{ $ticket->content }}" label="Content"/>
						<x-landlord.show.my-date-time	value="{{ $ticket->ticket_date }}"/>
						<x-landlord.show.my-text	value="{{ $ticket->owner->name }}" label="Requester"/>
						<x-landlord.show.my-badge	value="{{ $ticket->priority->name }}" label="Priority"/>
						<x-landlord.show.my-badge	value="{{ $ticket->dept->name }}" label="Dept"/>
						<x-landlord.show.my-badge	value="{{ $ticket->status->name }}" label="Status"/>
						<x-landlord.create.save/>
					</tbody>
				</table>
			</form>
		</div>
	</div>
@endsection
