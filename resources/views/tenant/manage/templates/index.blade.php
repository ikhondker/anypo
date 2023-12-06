@extends('layouts.app')
@section('title','Templates')
@section('breadcrumb','Templates v1.3 (6-MAR-23)')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Templates Lists
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.create object="Template"/>
        @endslot
    </x-tenant.page-header>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-actions float-end">
                        <form action="{{ route( 'templates.index') }}" method="GET" role="search">
                            <div class="btn-toolbar mb-4" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group me-2" role="group" aria-label="First group">
                                    <input type="text" class="form-control form-control-sm" name="term" placeholder="Search..." id="term">
                                    <button type="submit" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Search..."><i class="fa-solid fa-magnifying-glass"></i></button>
                                    <a href="{{ route( 'templates.index') }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </a>
                                    <a href="{{ route( 'templates.export') }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h5 class="card-title">Templates Lists</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="">Name</th>
                                <th class="">Phone</th>
                                <th class="">Date</th>
                                <th class="text-end">Amount</th>
                                <th class="">User Full Name</th>
                                <th class="">Role</th>
                                <th class="text-center">Enable</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($templates as $template)
                            <tr>
                                <td class="">{{ ++$i }}</td>
                                <td class=""><a class="text-info" href="{{ route('templates.show',$template->id) }}">{{ $template->name }}</a></td>
                                
                                <td class="">{{ $template->phone }}</td>
                                <td>{{ strtoupper(date('d-M-y', strtotime($template->my_date))) }}</td>
                                <td class="text-end">{{number_format($template->amount, 2)}} </td>
                                <td class="">{{  $template->user->name}}</td>
                                <td class=""><span class="badge bg-primary-light">{{  $template->my_enum}}</span> </td>
                                <td class="text-center">
                                    <x-tenant.list.my-boolean :value="$template->enable"/>
                                </td>
                                <td class="table-action">
                                    <x-tenant.list.actions object="Template" :id="$template->id"/>
                                    <a href="{{ route('templates.destroy',$template->id) }}" class="me-2 modal-boolean-advance" 
                                        data-entity="Template" data-name="{{ $template->name }}" data-status="{{ ($template->enable ? 'Disable' : 'Enable') }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($template->enable ? 'Disable' : 'Enable') }}">
                                        <i class="align-middle text-muted" data-feather="{{ ($template->enable ? 'bell-off' : 'bell') }}"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row pt-3">
                        {{ $templates->links() }}
                    </div>
                    <!-- end pagination -->

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

        </div>
    </div>

    @include('tenant.includes.modal-boolean-advance')    
@endsection

