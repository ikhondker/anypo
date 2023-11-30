@extends('layouts.app')
@section('title','Edit Group')
@section('breadcrumb','Edit Group')

@section('content')

    <x-page-header>
        @slot('title')
            Edit Group
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="Group"/>
            <x-buttons.header.create object="Group"/>
        @endslot
    </x-page-header>

    <!-- form start -->
    <form action="{{ route('groups.update',$group->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Group Info</h5>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">ID</label>
                                <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $group->id ) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Group Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    name="name" id="name" placeholder="Group Name"     
                                    value="{{ old('name', $group->name ) }}"
                                    />
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
                    <div class="card">
                        
                    </div>
                </div>
                <!-- end col-6 -->
            </div>

            
    </form>
    <!-- /.form end -->
@endsection

