@extends('layouts.app')
@section('title','Edit Warehouse')
@section('breadcrumb','Edit Warehouse')

@section('content')

    <x-page-header>
        @slot('title')
            Edit Warehouse
        @endslot
        @slot('buttons')
            <x-buttons.header.save/>
            <x-buttons.header.lists object="Warehouse"/>
            <x-buttons.header.create object="Warehouse"/>
        @endslot
    </x-page-header>

    <!-- form start -->
    <form id="myform" action="{{ route('warehouses.update',$warehouse->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Warehouse Info</h5>
                        </div>
                        <div class="card-body">
                            <x-edit.id-read-only :value="$warehouse->id"/>
                            <x-edit.name :value="$warehouse->name"/>
                            <x-edit.contact-person value="{{ $warehouse->contact_person }}"/>
                            <x-edit.cell value=" {{ $warehouse->cell }}"/>
                            <x-widgets.submit/>
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->

                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Warehouse Info</h5>
                        </div>
                        <div class="card-body">
                            <x-edit.address1 :value="$warehouse->address1"/>
                            <x-edit.address2 :value="$warehouse->address2"/>
                            <div class="row">
                                <x-edit.city :value="$warehouse->city"/>
                                <x-edit.state value="{{ $warehouse->state }}"/>
                                <x-edit.zip :value="$warehouse->zip"/>
                            </div>
                            <x-edit.country :value="$warehouse->country"/>
                        </div>        
                    </div>
                </div>
                <!-- end col-6 -->
            </div>

            
    </form>
    <!-- /.form end -->
@endsection

