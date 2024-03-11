@extends('layouts.landlord-app')
@section('title','Tickets')
@section('breadcrumb','My Tickets')

@section('content')

	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Ticket Lists
				@endif
			</h5>

			<div class="card-actions float-end">
				<!-- form -->
				<form action="{{ route('tickets.index') }}" method="GET" role="search">

					<div class="btn-group" role="group" aria-label="First group">

						<input type="text" class="form-control form-control-sm" minlength=3 name="term"
							placeholder="Search..." value="{{ old('term', request('term')) }}" id="term" required>

						<button type="submit" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top"
							title="Search..."><i class="bi bi-search"></i></button>

						<a href="{{ route('tickets.index') }}" class="btn btn-info me-1" data-bs-toggle="tooltip"
							data-bs-placement="top" title="Reload">
							<i class="bi bi-arrow-repeat"></i>
						</a>

						<a href="{{ route('tickets.export') }}" class="btn btn-info me-1" data-bs-toggle="tooltip"
							data-bs-placement="top" title="Download">
							<i class="bi bi-arrow-down-circle"></i>
						</a>

					</div>
					<a class="btn btn-primary" href="{{ route('tickets.create') }}">
						<i class="bi bi-plus-circle"></i> Create Ticket
					</a>
				</form>
				<!--/. form -->
			</div>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
				<tr>
					<th>&nbsp; &nbsp; Subject</th>
					<th>Priority</th>
					<th>Status</th>
					<th style="width: 5%;">Action</th>
				</tr>
				</thead>

				<tbody>
					@foreach ($tickets as $ticket)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle" src="{{ Storage::disk('s3la')->url($ticket->owner->avatar) }}"  alt="{{ $ticket->owner->name }}" title="{{ $ticket->owner->name }}">
									</div>
									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="{{ route('tickets.show',$ticket->id) }}">
											@if ( $ticket->status_code <>  App\Enum\LandlordTicketStatusEnum::CLOSED->value) 
												<h6 class="text-info mb-0">
											@else 
												<h6 class="text-secondary mb-0">
											@endif 
												[#{{ $ticket->id }}] {{ Str::limit($ticket->title, 45) }}
												</h6>
										</a>
										<small class="d-block"> {{ $ticket->owner->name }} | {{ strtoupper(date('d-M-Y', strtotime($ticket->ticket_date ))) }} | {{ $ticket->dept->name }} </small>
									</div>
								</div>

								{{-- <div class="flex-grow-1 ms-3">
									<a class="d-inline-block link-dark" href="{{ route('tickets.show',$ticket->id) }}">
										<h6 class="text-hover-primary mb-0">[#{{ $ticket->id }}] {{ Str::limit($ticket->title, 45) }}</h6>
									</a>
									<small class="d-block">{{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }}</small>
								</div> --}}
							</td>
							<td><x-landlord.list.my-badge :value="$ticket->priority->name" badge="{{ $ticket->priority->badge }}"/></td>
							<td><x-landlord.list.my-badge value="{{ $ticket->status->name }}" badge="{{ $ticket->status->badge }}"/></td>
							<td>
								<a href="{{ route('tickets.show',$ticket->id) }}" class="text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
									<i class="bi bi-eye" style="font-size: 1.3rem;"></i>
								</a>

								{{-- <x-landlord.list.actions object="Ticket" :id="$ticket->id"/> --}}
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
		<!-- End Table -->

		 <!-- card-body -->
		 <div class="card-body">
			<!-- pagination -->
			{{ $tickets->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

@endsection

@section('bo04-content')


	<x-landlord.card.header title="Tickets Lists"/>

	<!-- my-section-table -->
	<div class="my-section-table">
		<div class="table-responsive">
			<table class="table table-no-space table-bordered">
				<thead>
					<tr>
						<th class="">#</th>
						<th class="">Title</th>
						{{-- <th class="">Dept</th> --}}
						<th class="">Priority</th>
						<th class="">Owner</th>
						<th class="text-center">Status</th>
						<th class="text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tickets as $ticket)
					<tr>
						<td class=""><x-landlord.list.my-id-link object="Ticket" :id="$ticket->id"/></td>
						<td class="">
							<h6 class="mb-0 ms-3">{{ Str::limit($ticket->title, 35) }}<p class="text-xs text-muted p-0 m-0">{{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }}</p></h6>
						</td>
						{{-- <td class=""><x-landlord.list.my-badge :value="$ticket->dept->name" badge="danger"/></td> --}}
						<td class=""><x-landlord.list.my-badge :value="$ticket->priority->name" badge="danger"/></td>
						<td class="">{{ $ticket->owner->name }}</td>
						<td class=""><x-landlord.list.my-badge value="{{ $ticket->status->name }}" badge="danger"/></td>
						<td class="text-center">
							<a href="{{ route('tickets.show',$ticket->id) }}" class="action-btn btn-view bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
								<i data-feather="eye" class="fea text-muted"></i>
							</a>
						</td>
					</tr>
					@endforeach


				</tbody>
			</table>
		</div>
	</div>
	<!--/. my-section-table -->

	<!-- my-pagination -->
	<div class="row pt-3">
		{{ $tickets->links() }}
	</div>
	<!--/. my-pagination -->

@endsection
