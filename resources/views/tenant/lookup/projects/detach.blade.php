@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Remove Attachments
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.lists object="Project"/>
            <x-tenant.buttons.header.create object="Project"/>
            <x-tenant.buttons.header.edit object="Project" :id="$project->id"/>
            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a>
        @endslot
    </x-tenant.page-header>
    
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Project Info</h5>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-badge    value="{{ $project->id }}"/>
                    <x-tenant.show.my-text     value="{{ $project->name }}"/>
                    <x-tenant.show.my-date     value="{{ $project->start_date  }}"/>
                    <x-tenant.show.my-date     value="{{ $project->end_date  }}"/>
                    <x-tenant.show.my-text     value="{{ $project->pm->name }}" label="Manager"/>
                    <x-tenant.show.my-text     value="{{ $project->notes }}" label="Notes"/>
                    <x-tenant.show.my-boolean  value="{{ $project->closed }}"/>
                    <x-tenant.show.my-badge    value="{{ $project->id }}"/>
                </div>
            </div>

            

        </div>
    </div>
    <!-- end row -->
   
    @include('tenant.includes.detach-by-article')
 

@endsection

