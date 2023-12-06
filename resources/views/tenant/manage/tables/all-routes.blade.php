@extends('layouts.app')
@section('title',' All Routes List')
@section('breadcrumb')
    All Routes List
@endsection


@section('content')

    <x-tenant.page-header>
        @slot('title')
            All Routes List
        @endslot
        @slot('buttons')
            <x-tenant.table-links/>
        @endslot
    </x-tenant.page-header>

     
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">All Routes</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Method</th>
                                <th>URI</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            
                        </thead>
                        @php
                            $skip_routes = array(
                                'sanctum/csrf-cookie',
                                'livewire/message/{name}',
                                '{locale}/livewire/message/{name}',
                                'livewire/upload-file',
                                'livewire/preview-file/{filename}',
                                'livewire/livewire.js',
                                'livewire/livewire.js.map',
                                '_ignition/health-check',
                                '_ignition/execute-solution',
                                '_ignition/update-config',
                                'tenancy/assets/{path?}',
                                'api/user',
                                'api/user',
                                '/'
                            );
                        @endphp
                        <tbody>
                            @foreach($routes as $route)
                                @if (! in_array($route->uri(), $skip_routes ))
                                    <tr>
                                        <td> {{ ++$i }}</td>
                                        <td>{{ $route->methods()[0] }}</td>
                                        <td>{{ $route->uri() }}</td>
                                        <td>{{ $route->getName() }}</td>
                                        <td>{{ $route->getActionName() }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection

