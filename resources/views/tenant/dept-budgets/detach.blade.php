@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

    <x-page-header>
        @slot('title')
            Remove Attachments
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="DeptBudget"/>
            <x-buttons.header.create object="DeptBudget"/>
            <x-buttons.header.edit object="DeptBudget" :id="$deptBudget->id"/>
            <a href="{{ route('dept-budgets.show', $deptBudget->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Dept Budget</a>
        @endslot
    </x-page-header>
    
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">DeptBudget Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-badge    value="{{ $deptBudget->budget->fy }}" label="FY"/>
                    <x-show.my-text     value="{{ $deptBudget->budget->name }}" label="Name"/>
                    <x-show.my-text     value="{{ $deptBudget->dept->name }}" label="Dept"/>
                    <x-show.my-date     value="{{ $deptBudget->budget->start_date }}" label="Start Date"/>
                    <x-show.my-date     value="{{ $deptBudget->budget->end_date }}" label="End Date"/>
                    <x-show.my-boolean  value="{{ $deptBudget->freeze }}"/>
                    <x-show.my-badge    value="{{ $deptBudget->id }}"/>
                    <x-show.my-text     value="{{ $deptBudget->notes }}" label="Notes"/>

                </div>
            </div>

            

        </div>
    </div>
    <!-- end row -->
   
    @include('includes.detach-by-article')
 

@endsection

