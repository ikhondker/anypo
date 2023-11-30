@extends('layouts.app')
@section('title','Warehouse')
@section('breadcrumb','Create Warehouse')

@section('content')

    <x-page-header>
        @slot('title')
            Create Warehouse
        @endslot
        @slot('buttons')
            <x-buttons.header.save/>
            <x-buttons.header.lists object="Warehouse"/>
        @endslot
    </x-page-header>

    <!-- form start -->
    <form id="myform" action="{{ route('warehouses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                    <h5 class="card-title">Warehouse Info</h5>
                    </div>
                    <div class="card-body">
                        <x-create.name/>
                        <x-create.contact-person/>
                        <x-create.cell/>
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
                        <x-create.address1/>
                        <x-create.address2/>
                        <div class="row">
                            <x-create.city/>
                            <x-create.state/>
                            <x-create.zip/>
                        </div>
                        <x-create.country/>
                        <x-widgets.submit/>
                    </div>
                </div>
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->

    </form>
    <!-- /.form end -->

@endsection