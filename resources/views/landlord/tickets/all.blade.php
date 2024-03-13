@extends('layouts.landlord-app')
@section('title','Tickets')
@section('breadcrumb','All Tickets')


@section('content')

	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					All Tickets
				@endif
			</h5>
			{{-- <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">
				<i class="bi bi-plus-square me-1"></i> Create User
			</a> --}}
			<div class="card-actions float-end">
				<!-- form -->
				<form action="{{ route('tickets.all') }}" method="GET" role="search">

					<div class="btn-group" role="group" aria-label="First group">

						<input type="text" class="form-control form-control-sm" minlength=3 name="term"
							placeholder="Search..." value="{{ old('term', request('term')) }}" id="term" required>

						<button type="submit" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top"
							title="Search..."><i class="bi bi-search"></i></button>

						<a href="{{ route('tickets.all') }}" class="btn btn-info me-1" data-bs-toggle="tooltip"
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
					<th>Date</th>
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
										{{-- <i class="bi bi-person-circle text-danger" style="font-size: 1.3rem;"></i> --}}
									</div>
									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="{{ route('tickets.show',$ticket->id) }}">
											<h6 class="text-hover-primary mb-0">
												[#{{ $ticket->id }}] {{ Str::limit($ticket->title, 45) }}
											</h6>
										</a>
										<small class="d-block">
											{{ $ticket->owner->name }} | {{ $ticket->dept->name }}
											@if ( auth()->user()->isSeeded()  && ($ticket->agent_id <> ''))
												| {{ $ticket->agent->name }}
											@endif
										</small>
									</div>
								</div>
							</td>

							<td>{{ strtoupper(date('d-M-Y', strtotime($ticket->ticket_date ))) }}</td>
							<td><x-landlord.list.my-badge value="{{ $ticket->status->name }}" badge="{{ $ticket->status->badge }}"/></td>
							<td>
								<x-landlord.list.actions object="Ticket" :id="$ticket->id"/>
								<a href="{{ route('tickets.assign',$ticket->id) }}" class="text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Assign">
									@if ( $ticket->agent_id == '')
										<i class="bi bi-person-circle text-danger" style="font-size: 1.3rem;"></i>
									@else
										<i class="bi bi-person-circle" style="font-size: 1.3rem;"></i>
									@endif
								</a>
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

@section('content')


	<x-landlord.card.header title="Tickets Lists"/>

	<!-- my-section-table -->
	<div class="my-section-table">
		<div class="table-responsive">
			<table class="table table-no-space table-bordered">
				<thead>
					<tr>
						<th class="">#</th>
						<th class="">Title</th>
						{{-- <th class="">Created</th> --}}
						<th class="">Dept/
						Priority</th>
						<th class="">Owner/
						Agent</th>
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
						{{-- <td class=""><x-landlord.list.my-date :value="$ticket->ticket_date"/></td> --}}
						<td class=""><x-landlord.list.my-badge :value="$ticket->dept->name"/><br>
						<x-landlord.list.my-badge :value="$ticket->priority->name"/></td>
						<td class="">{{ $ticket->owner->name }}
							<p class="small text-info">
								@if ( $ticket->agent_id <> '')
									{{ $ticket->agent->name }}
								@else
									<a href="{{ route('tickets.assign',$ticket->id) }}" class="text-warning d-inline-block">Assign</a>
								@endif
							</p>
						</td>
						<td class=""><x-landlord.list.my-badge value="{{ $ticket->status->name }}"/></td>
						<td class="text-center">
							{{-- <x-landlord.list.actions object="Ticket" :id="$ticket->id" :edit="false" :enable="false"/> --}}
							<a href="{{ route('tickets.show',$ticket->id) }}" class="action-btn btn-view bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
								<i data-feather="eye" class="fea text-muted"></i>
							</a>
							<a href="{{ route('tickets.edit',$ticket->id) }}" class="action-btn btn-view bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
								<i data-feather="edit" class="fea text-muted"></i>
							</a>
							<a href="{{ route('tickets.assign',$ticket->id) }}" class="action-btn btn-view bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Assign">
								<i class="bi bi-person-circle"></i>
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


@section('sidebar')
	<a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sidebar">Create Ticket</a>
	<a href="{{ route('tickets.index') }}" class="btn btn-secondary btn-sidebar">Ticket Lists</a>
	<a href="javascript:void(0);" class="btn btn-success btn-sidebar">Download</a>
	<a href="{{ route('dashboards.index') }}" class="btn btn-dark btn-sidebar">Dashboard</a>
@endsection
