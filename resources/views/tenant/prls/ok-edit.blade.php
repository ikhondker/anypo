@extends('layouts.app')
@section('title','Edit Prl')
@section('breadcrumb','Edit Prl')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Edit Prl
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.lists object="Prl"/>
            <x-tenant.buttons.header.create object="Prl"/>
        @endslot
    </x-tenant.page-header>

    <!-- form start -->
    <form action="{{ route('prls.update',$prl->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Prl Info</h5>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">ID</label>
                                <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $prl->id ) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Prl Name</label>
                                <input type="text" class="form-control @error('summary') is-invalid @enderror" 
                                    name="summary" id="summary" placeholder="Prl summary"     
                                    value="{{ old('summary', $prl->summary ) }}"
                                    />
                                @error('summary')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <x-buttons.submit/>
                            
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

