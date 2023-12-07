@extends('layouts.landlord-app')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')

    <div class="d-grid gap-1 gap-lg-1">
        <div class="row">
            <x-landlord.widget.kpi value="1" label="OPEN TICKETS" icon="com013" route="tickets"/>
            <x-landlord.widget.kpi value="9" label="TOTAL TICKETS" route="tickets"/>
            <x-landlord.widget.kpi value="1" label="PENDING INVOICE" icon="abs029" route="invoices"/>
            <x-landlord.widget.kpi value="3" label="ACTIVE USERS" icon="com006" route="users"/>
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

        <x-landlord.widget.ticket-lists type="OPEN"/>
    
        <x-landlord.widget.ticket-lists type="CLOSED"/>
    </div>

    

@endsection
