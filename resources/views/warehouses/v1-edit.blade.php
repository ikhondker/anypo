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

                            <div class="mb-3">
                                <label class="form-label">ID</label>
                                <input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $warehouse->id ) }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Warehouse Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    name="name" id="name" placeholder="Warehouse Name"     
                                    value="{{ old('name', $warehouse->name ) }}"
                                    />
                                @error('name')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact Person</label>
                                <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                                    name="contact_person" id="contact_person" placeholder="Contact Persone"     
                                    value="{{ old('contact_person', $warehouse->contact_person ) }}"
                                    />
                                @error('contact_person')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Cell</label>
                                <input type="text" class="form-control @error('cell') is-invalid @enderror" 
                                    name="cell" id="cell" placeholder="01911310509"     
                                    value="{{ old('cell', $warehouse->cell ) }}"
                                    required/>
                                @error('cell')
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
                        <div class="card-header">
                            <h5 class="card-title">Warehouse Info</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Address 1</label>
                                <input type="text" class="form-control @error('address1') is-invalid @enderror" 
                                    name="address1" id="address1" placeholder="Address 1"     
                                    value="{{ old('address1', $warehouse->address1 ) }}"
                                    required/>
                                @error('address1')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address 2</label>
                                <input type="text" class="form-control @error('address2') is-invalid @enderror" 
                                    name="address2" id="address2" placeholder="Address 2"     
                                    value="{{ old('address2', $warehouse->address2 ) }}"
                                    />
                                @error('address2')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                        name="city" id="city" placeholder="City"     
                                        value="{{ old('city', $warehouse->city ) }}"
                                        required/>
                                    @error('city')
                                        <div class="text-danger text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                        name="state" id="state" placeholder="N/A"     
                                        value="{{ old('state', $warehouse->state ) }}"
                                        required/>
                                    @error('state')
                                        <div class="text-danger text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-2">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" class="form-control @error('zip') is-invalid @enderror" 
                                        name="zip" id="zip" placeholder="1234"     
                                        value="{{ old('zip', $warehouse->zip ) }}"
                                        required/>
                                    @error('zip')
                                        <div class="text-danger text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <select class="form-control" name="country">
                                    @foreach ($countries as $country)
                                        <option {{ $country->country == old('country',$warehouse->country) ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>        
                    </div>
                </div>
                <!-- end col-6 -->
            </div>

            
    </form>
    <!-- /.form end -->
@endsection

