@extends('layouts.app')
@section('title','Edit PR Line')

@section('content')

    <x-page-header>
        @slot('title')
            Edit PR Line
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="Pr"/>
            <x-buttons.header.create object="Pr"/>
            <x-buttons.header.edit object="Pr" :id="$pr->id"/>
            <x-buttons.header.pdf object="Pr" :id="$pr->id"/>
            <x-buttons.header.add-line object="Prl" :id="$pr->id"/>
        @endslot
    </x-page-header>
    
    @include('includes.view-pr-header')

    <!-- form start -->
    <form action="{{ route('prls.update',$prl->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        

        <!-- widget-pr-lines -->
        <x-widgets.pr-lines id="{{ $pr->id }}" :edit="true" pid="{{ $prl->id }}"/>
        <!-- /.widget-pr-lines -->

    </form>
    <!-- /.form end -->

    <!-- Approval History -->
    @if ($pr->wf_id <> 0)
        <x-widgets.approval-history id="{{ $pr->wf_id }}"/>
    @endif
    

    <!-- approval form, show only if pending to current auth user -->
    {{-- @if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
    @include('includes.wfd-approve-reject')
    @endif  --}}

      
@endsection

