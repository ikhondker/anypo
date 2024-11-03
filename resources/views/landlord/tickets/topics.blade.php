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
				@if (auth()->user()->isSeeded())
					<x-landlord.actions.ticket-actions ticketId="{{ $ticket->id }}"/>
				@endif
			   <a href="{{ route('tickets.create') }}" class="btn btn-primary float-end me-1"><i class="fas fa-plus"></i> New Ticket</a>
				<a href="{{ route('tickets.index') }}" class="btn btn-primary float-end me-1"><i class="fas fa-list"></i> View all</a>
				<a href="{{ route('reports.pdf-ticket', $ticket->id) }}" class="btn btn-primary float-end me-1"><i class="fas fa-print"></i> Print</a>
		@endslot
	</x-landlord.page-header>

	<!-- card-ticket-header -->
	<x-landlord.widgets.ticket-header ticketId="{{ $ticket->id }}"/>
	<!-- /.card-ticket-header -->

	<!-- BEGIN ADD Topics -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Add Topic</h5>
		</div>
		<div class="card-body">
			<form action="{{ route('tickets.add-topic',$ticket->id) }}" method="POST">
				@csrf
				<input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Topic :</th>
							<td>
								<select class="form-control select2" data-toggle="select2" name="topic_id" id="topic_id" required>
                                    <option value=""><< Topic >> </option>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}" {{ $topic->id == old('topic_id') ? 'selected' : '' }} >{{ $topic->name }} </option>
                                    @endforeach
                                </select>
                                @error('topic_id')
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
	<x-landlord.widgets.ticket-topics ticketId="{{ $ticket->id }}"/>
	<!-- /.card-ticket-topics -->

@endsection


