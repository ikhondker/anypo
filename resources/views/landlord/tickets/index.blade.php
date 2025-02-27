@extends('layouts.landlord.app')
@section('title','Tickets')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tickets.index') }}" class="text-muted">All Tickets</a></li>
@endsection

@section('content')

	<x-landlord.page-header>
		@slot('title')
			All Tickets
		@endslot
		@slot('buttons')
				<a href="{{ route('tickets.create') }}" class="btn btn-primary me-1"><i data-lucide="plus"></i> New Ticket</a>
				<x-landlord.actions.ticket-actions-index/>
			   @endslot
	</x-landlord.page-header>

	<div class="card">
		<div class="card-body">
			<div class="row mb-3">
				<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
					<!-- form -->
					<form action="{{ route('tickets.index') }}" method="GET" role="search">
						<div class="input-group input-group-search">
							<input type="text" class="form-control" id="datatables-ticket-search"
								minlength=3 name="term"
								value="{{ old('term', request('term')) }}" id="term"
								placeholder="Search Tickets…" required>
							<button class="btn" type="submit">
								<i data-lucide="search"></i>
							</button>
						</div>
							@if (request('term'))
								Search result for: <strong class="text-info">{{ request('term') }}</strong>
							@endif
					</form>
				</div>
				<div class="col-md-6 col-xl-8">
					<div class="text-sm-end">
						<a href="{{ route('tickets.index') }}" class="btn btn-primary btn-lg"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i data-lucide="refresh-cw"></i></a>
						<a href="{{ route('tickets.export') }}" class="btn btn-light btn-lg me-2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
							<i data-lucide="download"></i> Export</a>
					</div>
				</div>
			</div>

			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Subject</th>
						<th>Requestor</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tickets as $ticket)
						<tr>
							<td>
								<a class="text-muted" href="{{ route('tickets.show',$ticket->id) }}">
									@if ( $ticket->status_code <> App\Enum\Landlord\TicketStatusEnum::CLOSED->value)
										<i data-lucide="clock" class="text-warning"></i>
									@else
										<i data-lucide="check-circle" class="text-muted"></i>
									@endif
									<strong>{{ $ticket->id }}</strong>
								</a>
							</td>
							<td>{{ strtoupper(date('d-M-Y', strtotime($ticket->ticket_date ))) }}</td>
							<td>
								<a class="" href="{{ route('tickets.show', $ticket->id) }}">
									<strong class="text-muted mb-0">{{ Str::limit($ticket->title, 45) }}</strong>
								</a>
							</td>

							<td>
								<img src="{{ Storage::disk('s3l')->url('avatar/'.$ticket->owner->avatar) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $ticket->owner->name }}" title="{{ $ticket->owner->name }}">
								{{ $ticket->owner->name }}
							</td>

							<td>
								<x-landlord.list.my-badge value="{{ $ticket->status->name }}" badge="{{ $ticket->status->badge }}"/>
							</td>
							<td>
								<a href="{{ route('tickets.show',$ticket->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
									data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
								<a href="{{ route('reports.pdf-ticket', $ticket->id) }}" class="text-body"
									target="_blank" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Download"><i data-lucide="download"></i>
								</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row mb-3">
				{{ $tickets->links() }}
			</div>

		</div>
	</div>

@endsection

