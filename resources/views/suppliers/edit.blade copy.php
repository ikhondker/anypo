@extends('layouts.app')
@section('title','Edit Supplier')
@section('breadcrumb','Edit Supplier')

@section('content')

    <x-page-header>
        @slot('title')
            Edit Supplier
        @endslot
        @slot('buttons')
            <x-buttons.header.save/>
            <x-buttons.header.lists object="Supplier"/>
            <x-buttons.header.create object="Supplier"/>
        @endslot
    </x-page-header>

    <!-- form start -->
    <form id="myform" action="{{ route('suppliers.update',$supplier->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Supplier Info</h5>
                    </div>
                    <div class="card-body">
                        <x-edit.id-read-only value="{{ $supplier->id }}"/>
                        <x-edit.name value="{{ $supplier->name }}"/>
                        <x-edit.contact-person value="{{ $supplier->contact_person }}"/>
                        <x-edit.cell value="{{ $supplier->cell }}"/>
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
                        <x-edit.address1 value="{{ $supplier->address1 }}"/>
                        <x-edit.address2 value="{{ $supplier->address2 }}"/>
                        <div class="row">
                            <x-edit.city value="{{ $supplier->city }}"/>
                            <x-edit.state value="{{ $supplier->state }}"/>
                            <x-edit.zip value="{{ $supplier->zip }}"/>
                        </div>
                        <x-edit.country value="{{ $supplier->country }}"/>
                    </div>        
                </div>
            </div>
            <!-- end col-6 -->
        </div>

            
    </form>
    <!-- /.form end -->
@endsection

