@extends('layouts.app')
@section('title','View Dept')

@section('content')

    <x-page-header>
        @slot('title')
            View Dept
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="Dept"/>
            <x-buttons.header.create object="Dept"/>
            <x-buttons.header.edit object="Dept" :id="$dept->id"/>
        @endslot
    </x-page-header>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Dept Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text     value="{{ $dept->name }}"/>
                    <x-show.my-text     value="{{ $dept->prHierarchy->name }}" label="PR Hierarchy"/>
                    <x-show.my-text     value="{{ $dept->poHierarchy->name }}" label="PO Hierarchy"/>
                    <x-show.my-badge    value="{{ $dept->id }}" label="ID"/>
                    <x-show.my-boolean  value="{{ $dept->enable }}"/>
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
                    <x-show.my-date-time value="{{$dept->created_at }}" label="Created At"/>
                    <x-show.my-date-time value="{{$dept->updated_at }}" label="Updated At"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

@endsection

