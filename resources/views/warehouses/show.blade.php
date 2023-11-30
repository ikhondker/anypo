@extends('layouts.app')
@section('title','View Warehouse')

@section('content')

    <x-page-header>
        @slot('title')
            View Warehouse
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="Warehouse"/>
            <x-buttons.header.create object="Warehouse"/>
            <x-buttons.header.edit object="Warehouse" :id="$warehouse->id"/>
        @endslot
    </x-page-header>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Warehouse Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text     value="{{ $warehouse->name }}"/>
                    <x-show.my-email    value="{{ $warehouse->contact_person }}" label="Contact Person"/>    
                    <x-show.my-text     value="{{ $warehouse->cell }}" label="Cell"/>
                    <x-show.my-badge    value="{{ $warehouse->id }}"/>
                    <x-show.my-boolean  value="{{ $warehouse->enable }}"/>
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
                    <x-show.my-text value="{{ $warehouse->address1 }}" label="Address1"/>
                    <x-show.my-text value="{{ $warehouse->address2 }}" label="Address1"/>
                    <x-show.my-text value="{{ $warehouse->city.', '.$warehouse->state.', '.$warehouse->zip  }}" label="City"/>    
                    <x-show.my-text value="{{ $warehouse->relCountry->name }}" label="Country"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->


@endsection

