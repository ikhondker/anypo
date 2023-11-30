@extends('layouts.landlord-app')
@section('title','Ticket Assignment')

@section('breadcrumb','Ticket Assignment')

@section('content')

	<!-- Card -->
	<div class="card">

		<form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
			@csrf
			@method('PUT')

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Assign Ticket </h5>
				<button class="btn btn-primary btn-sm" type="submit"><i class="bi bi-save"></i> Assign</button>
			</div>

			<!-- Body -->
			<div class="card-body">
			
				<x-landlord.edit.agent      value="{{ $ticket->agent_id }}"/>
				<x-landlord.show.my-text    value="{{ $ticket->title }}" label="Title"/>
				<x-landlord.show.my-text    value="{{ $ticket->content }}" label="Content"/>
				<x-landlord.show.my-date-time value="{{ $ticket->ticket_date }}"/>
				<x-landlord.show.my-text    value="{{ $ticket->owner->name  }}" label="Requester"/>
				<x-landlord.show.my-badge   value="{{ $ticket->priority->name }}" label="Priority"/>
				<x-landlord.show.my-badge   value="{{ $ticket->dept->name }}" label="Dept"/>
				<x-landlord.show.my-badge   value="{{ $ticket->status->name }}" label="Status"/>
				
			</div>
			<!-- End Body -->

			<x-landlord.edit.save/>
		</form>
	</div>
	<!-- End Card -->
	
@endsection
