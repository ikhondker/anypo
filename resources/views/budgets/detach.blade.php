@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

    <x-page-header>
        @slot('title')
            Remove Attachments
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="Budget"/>
            <x-buttons.header.create object="Budget"/>
            <x-buttons.header.edit object="Budget" :id="$budget->id"/>
            <a href="{{ route('projects.show', $budget->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a>
        @endslot
    </x-page-header>
    
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Budget Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-badge    value="{{ $budget->id }}"/>
                    <x-show.my-text     value="{{ $budget->name }}"/>
                    <x-show.my-date     value="{{ $budget->start_date  }}"/>
                    <x-show.my-date     value="{{ $budget->end_date  }}"/>
                    <x-show.my-text     value="{{ $budget->name }}" label="Manager"/>
                    <x-show.my-text     value="{{ $budget->notes }}" label="Notes"/>
                    <x-show.my-boolean  value="{{ $budget->freeze }}"/>
                    <x-show.my-badge    value="{{ $budget->id }}"/>
                </div>
            </div>

            

        </div>
    </div>
    <!-- end row -->
   
    @include('includes.detach-by-article')
 

@endsection

