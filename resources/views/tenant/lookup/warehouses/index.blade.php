@extends('layouts.app')
@section('title','Warehouse')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Warehouse
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.create object="Warehouse"/>
        @endslot
    </x-tenant.page-header>

    <div class="row">
        <div class="col-8">

            <div class="card">
                <div class="card-header">
                    <x-tenant.cards.header-search-export-bar object="Warehouse"/>
                    <h5 class="card-title">
                        @if (request('term'))
                            Search result for: <strong class="text-danger">{{ request('term') }}</strong>
                        @else
                            Activity Lists
                        @endif
                    </h5>
                    <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Contact Person</th>
                                <th>Cell</th>
                                <th>Enable</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warehouses as $warehouse)
                            <tr>
                                <td>{{ $warehouse->id }}</td>
                                <td><a class="text-info" href="{{ route('warehouses.show',$warehouse->id) }}">{{ $warehouse->name }}</a></td>
                                <td>{{ $warehouse->contact_person }}</td>
                                <td>{{ $warehouse->cell }}</td>
                                <td><x-tenant.list.my-boolean :value="$warehouse->enable"/></td>
                                <td class="table-action">
                                    <x-tenant.list.actions object="Warehouse" :id="$warehouse->id"/>

                                    <a href="{{ route('warehouses.destroy',$warehouse->id) }}" class="me-2 modal-boolean-advance" 
                                        data-entity="Warehouse" data-name="{{ $warehouse->name }}" data-status="{{ ($warehouse->enable ? 'Disable' : 'Enable') }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($warehouse->enable ? 'Disable' : 'Enable') }}">
                                        <i class="align-middle text-muted" data-feather="{{ ($warehouse->enable ? 'bell-off' : 'bell') }}"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row pt-3">
                        {{ $warehouses->links() }}
                    </div>
                    <!-- end pagination -->
                    
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

        </div>
         <!-- end col -->
    </div>
     <!-- end row -->

     @include('tenant.includes.modal-boolean-advance')    

@endsection

