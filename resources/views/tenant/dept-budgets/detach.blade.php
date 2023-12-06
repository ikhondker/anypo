@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Remove Attachments
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.lists object="DeptBudget"/>
            <x-tenant.buttons.header.create object="DeptBudget"/>
            <x-tenant.buttons.header.edit object="DeptBudget" :id="$deptBudget->id"/>
            <a href="{{ route('dept-budgets.show', $deptBudget->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Dept Budget</a>
        @endslot
    </x-tenant.page-header>
    
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">DeptBudget Info</h5>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-badge    value="{{ $deptBudget->budget->fy }}" label="FY"/>
                    <x-tenant.show.my-text     value="{{ $deptBudget->budget->name }}" label="Name"/>
                    <x-tenant.show.my-text     value="{{ $deptBudget->dept->name }}" label="Dept"/>
                    <x-tenant.show.my-date     value="{{ $deptBudget->budget->start_date }}" label="Start Date"/>
                    <x-tenant.show.my-date     value="{{ $deptBudget->budget->end_date }}" label="End Date"/>
                    <x-tenant.show.my-boolean  value="{{ $deptBudget->freeze }}"/>
                    <x-tenant.show.my-badge    value="{{ $deptBudget->id }}"/>
                    <x-tenant.show.my-text     value="{{ $deptBudget->notes }}" label="Notes"/>

                </div>
            </div>

            

        </div>
    </div>
    <!-- end row -->
   
    @include('tenant.includes.detach-by-article')
 

@endsection

