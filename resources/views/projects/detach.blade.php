@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

    <x-page-header>
        @slot('title')
            Remove Attachments
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="Project"/>
            <x-buttons.header.create object="Project"/>
            <x-buttons.header.edit object="Project" :id="$project->id"/>
            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a>
        @endslot
    </x-page-header>
    
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Project Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-badge    value="{{ $project->id }}"/>
                    <x-show.my-text     value="{{ $project->name }}"/>
                    <x-show.my-date     value="{{ $project->start_date  }}"/>
                    <x-show.my-date     value="{{ $project->end_date  }}"/>
                    <x-show.my-text     value="{{ $project->pm->name }}" label="Manager"/>
                    <x-show.my-text     value="{{ $project->notes }}" label="Notes"/>
                    <x-show.my-boolean  value="{{ $project->closed }}"/>
                    <x-show.my-badge    value="{{ $project->id }}"/>
                </div>
            </div>

            

        </div>
    </div>
    <!-- end row -->
   
    @include('includes.detach-by-article')
 

@endsection

