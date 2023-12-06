@extends('layouts.app')
@section('title','Edit Uom')
@section('breadcrumb','Edit Uom')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Edit Uom
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.save/>
            <x-tenant.buttons.header.lists object="Uom"/>
            <x-tenant.buttons.header.create object="Uom"/>
        @endslot
    </x-tenant.page-header>

    <!-- form start -->
    <form id="myform" action="{{ route('uoms.update',$uom->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Uom Info</h5>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">ID</label>
                                <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $uom->id ) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Uom Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    name="name" id="name" placeholder="Uom Name"     
                                    value="{{ old('name', $uom->name ) }}"
                                    />
                                @error('name')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <x-tenant.widgets.submit/>
                            
                        </div>
                    </div>
                </div>
                <!-- end col-6 -->

                <div class="col-6">
                    <div class="card">
                        
                    </div>
                </div>
                <!-- end col-6 -->
            </div>

            
    </form>
    <!-- /.form end -->
@endsection

