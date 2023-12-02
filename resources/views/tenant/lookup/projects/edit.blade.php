@extends('layouts.app')
@section('title','Edit Project')
@section('breadcrumb','Edit Project')

@section('content')

    <x-page-header>
        @slot('title')
            Edit Project
        @endslot
        @slot('buttons')
            <x-buttons.header.save/>
            <x-buttons.header.lists object="Project"/>
            <x-buttons.header.create object="Project"/>
        @endslot
    </x-page-header>

    <!-- form start -->
    <form id="myform" action="{{ route('projects.update',$project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Project Info</h5>
                        </div>
                        <div class="card-body">

                            <x-edit.id-read-only :value="$project->id"/>
                            <x-edit.name :value="$project->name"/>
                            <x-edit.start-date :value="date('Y-m-d',strtotime($project->start_date))"/>
                            <x-edit.end-date :value="date('Y-m-d',strtotime($project->end_date))"/>
                            <div class="mb-3">
                                <label class="form-label">Project Manager</label>
                                <select class="form-control" name="pm_id">
                                    @foreach ($pms as $user)
                                        <option {{ $user->id == old('pm_id',$project->pm_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <x-widgets.submit/>
 
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Project Info</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-check m-0">
                                <input type="checkbox" class="form-check-input"
                                    name="budget_control" id="budget_control" @checked($project->budget_control)/>
                                    <span class="form-check-label text-danger"> Control Budget?</span>
                                </label>
                            </div>

                            <x-edit.amount :value="$project->amount"/>

                            <x-widgets.submit/>
 
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->
            </div>

            
    </form>
    <!-- /.form end -->
@endsection

