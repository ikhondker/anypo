@extends('layouts.app')
@section('title','Oem')
@section('breadcrumb','Create Oem')

@section('content')

    <x-page-header>
        @slot('title')
            Create Oem
        @endslot
        @slot('buttons')
            <x-buttons.header.save/>
            <x-buttons.header.lists object="Oem"/>
        @endslot
    </x-page-header>

    <!-- form start -->
    <form id="myform" action="{{ route('oems.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                    <h5 class="card-title">Oem Info</h5>
                    </div>
                    <div class="card-body">
                        
                        
                        <div class="mb-3">
                            <label class="form-label">Oem Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                name="name" id="name" placeholder="Oem Name"     
                                value="{{ old('name', '' ) }}"
                                required/>
                            @error('name')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <x-widgets.submit/>
                    </div>
                </div>
            </div>
            <!-- end col-6 -->
            <div class="col-6">
                
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->

    </form>
    <!-- /.form end -->

@endsection