@extends('layouts.app')
@section('title','Warehouse')
@section('breadcrumb','Create Warehouse')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            Create Warehouse
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.save/>
            <x-tenant.buttons.header.lists object="Warehouse"/>
        @endslot
    </x-tenant.page-header>

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
                        
                        <x-tenant.create.name/>
                       
                        <div class="mb-3">
                            <label class="form-label">Warehouse Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                name="name" id="name" placeholder="Warehouse Name"     
                                value="{{ old('name', '' ) }}"
                                required/>
                            @error('name')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Contact Person</label>
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                                name="contact_person" id="contact_person" placeholder="Contact Person"     
                                value="{{ old('contact_person', '' ) }}"
                                required/>
                            @error('contact_person')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cell</label>
                            <input type="text" class="form-control @error('cell') is-invalid @enderror" 
                                name="cell" id="cell" placeholder="01911310509"     
                                value="{{ old('cell', '01911310509' ) }}"
                                required/>
                            @error('cell')
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
                    <div class="card-header">
                    <h5 class="card-title">Warehouse Info</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Address1</label>
                            <input type="text" class="form-control @error('address1') is-invalid @enderror" 
                                name="address1" id="address1" placeholder="Address"     
                                value="{{ old('address1', 'Address' ) }}"
                                required/>
                            @error('address1')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address2</label>
                            <input type="text" class="form-control @error('address2') is-invalid @enderror" 
                                name="address2" id="address2" placeholder="Address"     
                                value="{{ old('address2', 'Address' ) }}"
                                required/>
                            @error('address2')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                    name="city" id="city" placeholder="City"     
                                    value="{{ old('city', 'City' ) }}"
                                    required/>
                                @error('city')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                    name="state" id="state" placeholder="N/A"     
                                    value="{{ old('state', 'State' ) }}"
                                    required/>
                                @error('state')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-2">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control @error('zip') is-invalid @enderror" 
                                    name="zip" id="zip" placeholder="1234"     
                                    value="{{ old('zip', 'zip' ) }}"
                                    required/>
                                @error('zip')
                                    <div class="text-danger text-xs">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="form-control" name="country">
                                <option value=""><< Country >> </option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->country }}" {{ $country->country == old('country') ? 'selected' : '' }} >{{ $country->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <x-tenant.widgets.submit/>
                    </div>
                </div>
            </div>
            <!-- end col-6 -->
        </div>
        <!-- end row -->

    </form>
    <!-- /.form end -->

@endsection