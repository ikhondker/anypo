@extends('layouts.app')
@section('title','View Purchase Requisition')

@section('content')

    <x-page-header>
        @slot('title')
            View Purchase Requisition
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="Pr"/>
            <x-buttons.header.create object="Pr"/>
            <x-buttons.header.edit object="Pr" :id="$pr->id"/>
            <a href="{{ route('prls.createline', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fas fa-plus"></i> Add Line</a>
            <a href="{{ route('reports.pr', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fas fa-print"></i> Print</a>
            <a href="{{ route('prs.submit', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fas fa-check-to-slot"></i> Submit</a>
            <a href="{{ route('prs.submit', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fa-solid fa-sack-dollar"></i> Payment</a>
        @endslot
    </x-page-header>
    
    @include('includes.view-pr-header')

    <!-- widget-pr-lines -->
    <x-widgets.pr-lines id="{{ $pr->id }}" :show="true"/>
        
    <!-- /.widget-pr-lines -->

    <!-- approval form, show only if pending to current auth user -->
    @if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
        @include('includes.wfl-approve-reject')
    @endif 


    <!-- Approval History -->
    @if ($pr->wf_id <> 0)
        <x-widgets.approval-history id="{{ $pr->wf_id }}"/>
    @endif
    
    
      
@endsection

