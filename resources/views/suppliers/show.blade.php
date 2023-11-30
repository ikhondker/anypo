@extends('layouts.app')
@section('title','View Supplier')

@section('content')

    <x-page-header>
        @slot('title')
            View Supplier
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="Supplier"/>
            <x-buttons.header.create object="Supplier"/>
            <x-buttons.header.edit object="Supplier" :id="$supplier->id"/>
        @endslot
    </x-page-header>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Supplier Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text     value="{{ $supplier->name }}"/>
                    <x-show.my-text     value="{{ $supplier->contact_person }}" label="Contact Person"/>
                    <x-show.my-text     value="{{ $supplier->cell }}" label="Cell"/>
                    <x-show.my-email    value="{{ $supplier->email }}"/>
                    <x-show.my-url      value="{{ $supplier->website }}"/>
                    <x-show.my-badge    value="{{ $supplier->id }}"/>
                    <x-show.my-boolean  value="{{ $supplier->enable }}"/>
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
                    <x-show.my-text value="{{ $supplier->address1 }}" label="Address1"/>
                    <x-show.my-text value="{{ $supplier->address2 }}" label="Address2"/>
                    <x-show.my-text value="{{ $supplier->city.', '.$supplier->state.', '.$supplier->zip  }}" label="City"/>    
                    <x-show.my-text value="{{ $supplier->relCountry->name }}" label="Country"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->


@endsection

