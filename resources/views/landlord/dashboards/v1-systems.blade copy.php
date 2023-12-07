@extends('layouts.landlord-app')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')

    <div class="d-grid gap-3 gap-lg-5">
        <div class="row mb-5 mb-md-9">
            @include('includes.w')
            @include('includes.w')
            @include('includes.w')
            @include('includes.w')
        </div>
        <!-- End Row -->
    </div>



    {{-- <!-- Icon Blocks -->
    <div class="container">
        <!-- Card -->
        <div class="card">
            <!-- Body -->
            <div class="card-body">
                
            </div>
        </div>
       
    </div>
    <!-- End Icon Blocks --> --}}

    {{-- <div class="d-grid gap-3 gap-lg-5">
        <div class="row">
            
        </div>
        <!-- End Row -->
    </div> --}}

    <div class="d-grid gap-3 gap-lg-5">

        <!-- Card -->
        <div class="card">
            <!-- Body -->
            <div class="card-body">
                <div class="row row-cols-1 row-cols-sm-2 1 row-cols-md-3 row-cols-lg-4 mb-5">
                    <div class="col mb-3 mb-sm-4">
                        <!-- Card -->
                        <a class="card card-sm card-bordered card-transition" href="../demo-jobs/job-overview.html">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title text-inherit">Management</h5>
                                        <p class="card-text text-body small">4 job positions</p>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                            </div>
                        </a>
                        <!-- End Card -->
                    </div>
                    <!-- End Col -->

                    <div class="col mb-3 mb-sm-4">
                        <!-- Card -->
                        <a class="card card-sm card-bordered card-transition" href="../demo-jobs/job-overview.html">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title text-inherit">Management</h5>
                                        <p class="card-text text-body small">4 job positions</p>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                            </div>
                        </a>
                        <!-- End Card -->
                    </div>
                    <!-- End Col -->

                    <div class="col mb-3 mb-sm-4">
                        <!-- Card -->
                        <a class="card card-sm card-bordered card-transition" href="../demo-jobs/job-overview.html">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title text-inherit">Management</h5>
                                        <p class="card-text text-body small">4 job positions</p>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                            </div>
                        </a>
                        <!-- End Card -->
                    </div>
                    <!-- End Col -->

                    <div class="col mb-3 mb-sm-4">
                        <!-- Card -->
                        <a class="card card-sm card-bordered card-transition" href="../demo-jobs/job-overview.html">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title text-inherit">Management</h5>
                                        <p class="card-text text-body small">4 job positions</p>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                            </div>
                        </a>
                        <!-- End Card -->
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Body -->
        </div>
        <!-- End Card -->

        @if ($setup->show_message)
            <div class="alert alert-icon-left alert-light-danger alert-dismissible fade show mb-4" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg
                        data-bs-dismiss="alert"> ... </svg></button>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-alert-triangle">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                    </path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                <strong>Notice!</strong> {{ $setup->message }}
            </div>
        @endif


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




        <!-- card-numbers -->
        {{-- <div class="card col-10"> --}}
        <div class="row p-2 col-12">
            <div class="col-sm-2">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart"
                                class="fea text-secondary"></i>{{ $count_notif }}</h2>
                        <a href="{{ route('notifications.index') }}" class="text-white d-inline-block">NOTIFICATION</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart"
                                class="fea text-secondary"></i>{{ $count_tickets }}</h2>
                        <a href="{{ route('tickets.all') }}" class="text-white d-inline-block">TICKETS</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart"
                                class="fea text-secondary"></i>{{ $count_service }}</h2>
                        <a href="{{ route('services.index') }}" class="text-white d-inline-block">SERVICES</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart" class="fea text-secondary"></i>
                            {{ $count_invoices }}</h2>
                        <a href="{{ route('invoices.index') }}" class="text-white d-inline-block">INVOICES</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart"
                                class="fea text-secondary"></i>{{ $count_payments }}</h2>
                        <a href="{{ route('payments.index') }}" class="text-white d-inline-block">PAYMENTS</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart"
                                class="fea text-secondary"></i>{{ $count_users }}</h2>
                        <a href="{{ route('users.index') }}" class="text-white d-inline-block">USERS</a>
                    </div>
                </div>
            </div>

        </div>
        {{-- </div>     --}}
        <!-- /.card-numbers -->

        <!-- card-notifications -->
        <div class="card mt-2 col-12">
            <x-landlord.card.header title="Notifications" />
            <div class="card-body pt-1">
                <x-landlord.wf.notification-unread />
            </div>
        </div>
        <!-- /.card-notifications -->
    </div>
@endsection
