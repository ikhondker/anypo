@extends('layouts.landlord-app')
@section('title','All Domains')
@section('breadcrumb','All Domains')


@section('content')
    <!-- Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-header-title">All Domains</h5>
        </div>
    
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                <thead class="thead-light">
                    <tr>
                        <th>Tenant</th>
                        <th>ID</th>
                        <th>Domain</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th style="width: 5%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($domains as $domain)
                    <tr>
                        <td>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img class="avatar avatar-sm avatar-circle" src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Logo">
                            </div>
            
                            <div class="flex-grow-1 ms-3">
                                <a class="d-inline-block link-dark" href="#">
                                    <h6 class="text-hover-primary mb-0">{{ $domain->tenant_id }}</h6>
                                </a>
                            <small class="d-block">id: {{ $domain->tenant_id }}</small>
                            </div>
                        </div>
                        </td>
                        <td>{{ $domain->domain }}</td>
                        <td>{{ $domain->id }}</td>
                        <td><x-landlord.list.my-date :value="$domain->created_at"/></td>
                        <td><x-landlord.list.my-badge :value="$domain->tenant_id"/></td>
                        <td><x-landlord.list.actions object="Domain" :id="$domain->id" :export="false" :enable="false"/></td>
                    </tr>
                
                    @endforeach
                </tbody>


            </table>
        </div>
        <!-- End Table -->
    

        <!-- card-body -->
        <div class="card-body">
            <!-- pagination -->
            {{ $domains->links() }}
            <!--/. pagination -->
        </div>
        <!-- /. card-body -->

    </div>
    <!-- End Card -->
@endsection
