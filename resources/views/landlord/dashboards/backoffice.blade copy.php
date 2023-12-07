@extends('layouts.landlord-app')
@section('title','Dashboard')
@section('breadcrumb','Dashboard')

@section('content')
	<div class="d-grid gap-1 gap-lg-1">
		<div class="row">
			<x-landlord.widget.kpi value="{{ $count_agent_open_tickets }}" route="tickets"  label="ASSIGNED TO ME" icon="com013"/>
			<x-landlord.widget.kpi value="{{ $count_unassigned_tickets }}" route="tickets" label="TOTAL UNASSIGNED" icon="abs027"/>
			<x-landlord.widget.kpi value="{{ $count_all_open_tickets }}" route="accounts" label="TOTAL OPEN"  icon="abs029"/>
			<x-landlord.widget.kpi value="{{ $count_agent_closed_tickets }}" route="services" label="CLOSED BY ME"  icon="com006"/>
		</div>
		<!-- End Row -->
	</div>


	<!-- ========== NOTICE ========== -->
	@include('landlord.includes.notice')
	<!-- ========== END NOTICE ========== -->

	<div class="d-grid gap-3 gap-lg-5">
		<!-- Card -->
		<div class="card">

			<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
				<h5 class="card-header-title">Unassigned 5 Tickets</h5>
				<a class="btn btn-primary btn-sm" href="{{ route('tickets.create') }}">
					<i class="bi bi-plus-square me-1"></i> Create Ticket
				</a>
			</div>

			<!-- Table -->
			<div class="table-responsive">
				<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
					<thead class="thead-light">
						<tr>
							<th>&nbsp; &nbsp; Tickets</th>
							<th>Priority</th>
							<th>Status</th>
							<th style="width: 5%;">Action</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($tickets as $ticket)
							<tr>
								<td>
									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark"
											href="{{ route('tickets.show', $ticket->id) }}">
											<h6 class="text-hover-primary mb-0">[#{{ $ticket->id }}]
												{{ Str::limit($ticket->title, 45) }}</h6>
										</a>
										<small
											class="d-block">{{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date))) }}</small>
									</div>
								</td>
								<td><x-landlord.list.my-badge :value="$ticket->priority->name" badge="{{ $ticket->priority->badge }}" />
								</td>
								<td><x-landlord.list.my-badge value="{{ $ticket->status->name }}"
										badge="{{ $ticket->status->badge }}" /></td>
								<td>
									<x-landlord.list.actions object="Ticket" :id="$ticket->id" />
									<a href="{{ route('tickets.assign', $ticket->id) }}" class="text-body"
										data-bs-toggle="tooltip" data-bs-placement="top" title="Assign">
										<i class="bi bi-person-circle text-danger" style="font-size: 1.3rem;"></i>
									</a>

								</td>
							</tr>
						@endforeach

					</tbody>
				</table>
			</div>
			<!-- End Table -->

		</div>
		<!-- End Card -->

		<x-landlord.widget.ticket-lists type="UNASSIGNED"/>

		<x-landlord.widget.ticket-lists type="MY"/>
	
		<x-landlord.widget.ticket-lists type="OPEN"/>
	</div>


@endsection
