@extends('layouts.landlord.app')
@section('title','Edit Ticket')
@section('breadcrumb','Edit Tickets')


@section('content')

<h1 class="h3 mb-3">Edit Ticket</h1>

<div class="card">
	<div class="card-header">

		<h5 class="card-title">Edit Ticket (Admin Only)</h5>
		<h6 class="card-subtitle text-muted">Edit Ticket Details.</h6>
	</div>
	<div class="card-body">
		<form action="{{ route('tickets.update',$ticket->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<table class="table table-sm my-2">
				<tbody>
						
					<x-landlord.edit.id-read-only :value="$ticket->id"/>
					<x-landlord.edit.title :value="$ticket->title"/>
					<x-landlord.edit.content :value="$ticket->content"/>
					<x-landlord.edit.dept :value="$ticket->dept_id"/>
					<x-landlord.edit.priority :value="$ticket->priority_id"/>
					<x-landlord.edit.agent value="{{ $ticket->agent_id }}"/>
					<tr>
						<th>Requester :</th>
						<td>
							{{ $ticket->owner->name }}
						</td>
					</tr>
					<tr>
						<th>Status :</th>
						<td>
							<span class="badge badge-subtle-info">{{ $ticket->status->name }}</span>
						</td>
					</tr>

				</tbody>
			</table>

			<x-landlord.edit.save/>
		</form>
	</div>
</div>

	

@endsection
