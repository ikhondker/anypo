@extends('layouts.app')
@section('title','Edit Budget')
@section('breadcrumb','Edit Budget')

@section('content')

    <x-page-header>
        @slot('title')
            Edit Budget
        @endslot
        @slot('buttons')
            <x-buttons.header.save/>
            <x-buttons.header.lists object="Budget"/>
            <x-buttons.header.create object="Budget"/>
        @endslot
    </x-page-header>

    <!-- form start -->
    <form id="myform" action="{{ route('budgets.update',$budget->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Budget Info</h5>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">FY</label>
                                <input type="text" name="fy" id="fy" class="form-control" placeholder="ID" value="{{ $budget->fy }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Budget Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    name="name" id="name" placeholder="Budget Name"     
                                    value="{{ old('name', $budget->name ) }}"
                                    />
                                @error('name')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <x-edit.notes value="{{ $budget->notes }}"/>
                            <x-widgets.submit/>
                            
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

