@extends('layouts.landlord-app')
@section('title','Edit Ticket')
@section('breadcrumb','Edit Tickets')


@section('content')

	<!-- Card -->
	<div class="card">

		<form action="{{ route('tickets.update',$ticket->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Edit Ticket info</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-floppy"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">

				<x-landlord.show.my-badge value="{{ $ticket->status->name }}" label="Status"/>
				<x-landlord.show.my-text value="{{ $ticket->owner->name }}" label="Requester"/>
				<x-landlord.edit.id-read-only :value="$ticket->id"/>
				<x-landlord.edit.title :value="$ticket->title"/>
				<x-landlord.edit.content :value="$ticket->content"/>
				<x-landlord.edit.dept :value="$ticket->dept_id"/>
				<x-landlord.edit.priority :value="$ticket->priority_id"/>
				<x-landlord.edit.agent value="{{ $ticket->agent_id }}"/>


			</div>
			<!-- End Body -->

			<x-landlord.edit.save/>
		</form>
	</div>
	<!-- End Card -->

@endsection
