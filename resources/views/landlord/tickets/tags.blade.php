@extends('layouts.landlord.app')
@section('title','View Ticket Topics')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-muted">Tickets</a></li>
	<li class="breadcrumb-item active">#{{ $ticket->id }}</li>
@endsection

@section('content')


	<x-landlord.page-header>
		@slot('title')
			Ticket #{{ $ticket->id }} Topics
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

	<!-- BEGIN ADD Topics -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Add Tag</h5>
		</div>
		<div class="card-body">
			<form action="{{ route('tickets.add-tag',$ticket->id) }}" method="POST">
				@csrf
				<input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Tag :</th>
							<td>
								<select class="form-control select2" data-toggle="select2" name="tag_id" id="tag_id" required>
									<option value=""><< Tag >> </option>
									@foreach ($tags as $tag)
										<option value="{{ $tag->id }}" {{ $tag->id == old('tag_id') ? 'selected' : '' }} >{{ $tag->name }}</option>
									@endforeach
								</select>
								@error('tag_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
					</tbody>
				</table>
				<x-landlord.create.save/>
			</form>
			<!-- Form -->
		</div>
	</div>
	<!-- END ADD Topics -->

	<!-- card-ticket-topics -->
	<x-landlord.widgets.ticket-tags ticketId="{{ $ticket->id }}"/>
	<!-- /.card-ticket-topics -->

@endsection


