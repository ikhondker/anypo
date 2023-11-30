@extends('layouts.landlord-app')
@section('title','Dashboard')
@section('breadcrumb','Dashboard')

@section('content')
    
    @if ($setup->show_message)
        <div class="alert alert-icon-left alert-light-danger alert-dismissible fade show mb-4" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg  data-bs-dismiss="alert"> ... </svg></button>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
            <strong>Notice!</strong> {{ $setup->message }}
        </div>
    @endif

    <!-- card-numbers -->
    {{-- <div class="card col-10"> --}}
        <div class="row p-2 col-12">
            <div class="col-sm-2">    
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart" class="fea text-secondary"></i>{{ $count_notif }}</h2>
                        <a href="{{ route('notifications.index') }}" class="text-white d-inline-block">NOTIFICATION</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">    
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart" class="fea text-secondary"></i>{{ $count_all_open_tickets }}</h2>
                        <a href="{{ route('tickets.index') }}" class="text-white d-inline-block">TICKETS</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">    
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart" class="fea text-secondary"></i>{{ $count_unassigned_tickets }}</h2>
                        <a href="{{ route('tickets.index') }}" class="text-white d-inline-block">UNASSIGNED</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">    
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart" class="fea text-secondary"></i>  {{ $count_all_onhold_tickets }}</h2>
                        <a href="{{ route('invoices.index') }}" class="text-white d-inline-block">ONHOLD</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">    
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart" class="fea text-secondary"></i>{{ $count_service }}</h2>
                        <a href="{{ route('payments.index') }}" class="text-white d-inline-block">SERVICES</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">    
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white p-0 m-0"><i data-feather="pie-chart" class="fea text-secondary"></i>{{ $count_users }}</h2>
                        <a href="{{ route('users.index') }}" class="text-white d-inline-block">USERS</a>
                    </div>
                </div>
            </div>
            
        </div>
    {{-- </div>     --}}
    <!-- /.card-numbers -->

    <!-- card-notifications -->
    <div class="card mt-2 col-12">
        <x-landlord.card.header title="Notifications"/>
        <div class="card-body pt-1">
            <x-landlord.wf.notification-unread/>
        </div>
    </div>
    <!-- /.card-notifications -->

@endsection

@section('sidebar')
    <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sidebar">Create Ticket</a>
    <a href="{{ route('users.create') }}" class="btn btn-secondary btn-sidebar">Create User</a>
    <a href="{{ route('users.index') }}" class="btn btn-success btn-sidebar">User List</a>
    <a href="{{ route('dashboards.index') }}" class="btn btn-dark btn-sidebar">Dashboard</a>
@endsection
