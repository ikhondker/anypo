@extends('layouts.app')
@section('title','Edit Dept')
@section('breadcrumb','Edit Dept')

@section('content')

    <x-page-header>
        @slot('title')
            Edit Dept
        @endslot
        @slot('buttons')
            <x-buttons.header.save/>
            <x-buttons.header.lists object="Dept"/>
            <x-buttons.header.create object="Dept"/>
        @endslot
    </x-page-header>

    <!-- form start -->
    <form id="myform" action="{{ route('depts.update',$dept->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Dept Info</h5>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">ID</label>
                                <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $dept->id ) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Dept Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    name="name" id="name" placeholder="Dept Name"     
                                    value="{{ old('name', $dept->name ) }}"
                                    />
                                @error('name')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">PR Hierarchy</label>
                                <select class="form-control" name="pr_hierarchy_id">
                                    @foreach ($hierarchies as $hierarchy)
                                        <option {{ $hierarchy->id == old('pr_hierarchy_id',$dept->pr_hierarchy_id) ? 'selected' : '' }} value="{{ $hierarchy->id }}">{{ $hierarchy->name }} </option>
                                    @endforeach
                                </select>
                                @error('pr_hierarchy_id')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">PO Hierarchy</label>
                                <select class="form-control" name="po_hierarchy_id">
                                    @foreach ($hierarchies as $hierarchy)
                                        <option {{ $hierarchy->id == old('po_hierarchy_id',$dept->po_hierarchy_id) ? 'selected' : '' }} value="{{ $hierarchy->id }}">{{ $hierarchy->name }} </option>
                                    @endforeach
                                </select>
                                @error('po_hierarchy_id')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>

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

