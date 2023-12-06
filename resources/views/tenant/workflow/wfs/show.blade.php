@extends('layouts.app')
@section('title','Wf')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Wf
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.lists object="Wf"/>
            <x-tenant.buttons.header.create object="Wf"/>
            <x-tenant.buttons.header.edit object="Wf" :id="$wf->id"/>
        @endslot
    </x-tenant.page-header>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Wf Info</h5>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-badge    value="{{ $wf->id }}" label="ID"/>
                    <x-tenant.show.my-text     value="{{ $wf->entity }}" label="Entity"/>
                    <x-tenant.show.my-text     value="{{ $wf->article_id }}" label="Article"/>
                    <x-tenant.show.my-text     value="{{ $wf->relHierarchy->name }}" label="Hierarchy Name"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Supporting Info</h5>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-badge    value="{{ $wf->wf_status }}" label="WF Status"/>
                    <x-tenant.show.my-badge    value="{{ $wf->auth_status }}" label="Auth Status"/>
                    <x-tenant.show.my-text    value="{{ $wf->last_performer->name }}" label="Final Approver"/>
                    <x-tenant.show.my-date-time    value="{{ $wf->auth_date }}" label="Auth Date"/>
                    {{-- <x-tenant.show.my-date-time value="{{$wf->created_at }}" label="Created At"/>
                    <x-tenant.show.my-date-time value="{{$wf->updated_at }}" label="Updated At"/> --}}
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Wf Details</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Approver Name</th>
                                <th>Assign Date</th>
                                <th>Action</th>
                                <th>Action Date</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wfls as $wfl)
                            <tr>
                                <td><span class="badge bg-primary-light">{{ $wfl->id }}</span></td>
                                <td>{{ $wfl->performer->name }}</td>
                                <td>{{ $wfl->assign_date }} </td>
                                <td>{{ $wfl->action }} </td>
                                <td>{{ $wfl->action_date }} </td>
                                <td>{{ $wfl->notes }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- end col-6 -->
        <div class="col-6">
           
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

    

@endsection

