@extends('layouts.app')
@section('title','Edit Item')
@section('breadcrumb','Edit Item')

@section('content')

    <x-page-header>
        @slot('title')
            Edit Item
        @endslot
        @slot('buttons')
        <x-buttons.header.save/>
            <x-buttons.header.lists object="Item"/>
            <x-buttons.header.create object="Item"/>
        @endslot
    </x-page-header>

    <!-- form start -->
    <form id="myform" action="{{ route('items.update',$item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Item Info</h5>
                        </div>
                        <div class="card-body">

                            <x-edit.id-read-only :value="$item->id"/>
                            <x-edit.name :value="$item->name"/>
                            <x-edit.price :value="$item->price"/>


                                <div class="mb-3 col-md-6">
                                    <label for="code" class="form-label">Code</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                        name="code" id="code" placeholder="XXXX" maxlength="10"
                                        style="text-transform: uppercase"    
                                        value="{{ old('code', $item->code ) }}"
                                        required/>
                                    @error('code')
                                        <div class="text-danger text-xs">{{ $message }}</div>
                                    @enderror
                                </div>


                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-control" name="category_id">
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == old('pm_id',$item->category_id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">UoM</label>
                                <select class="form-control" name="uom_id">
                                    @foreach ($uoms as $uom)
                                        <option {{ $uom->id == old('pm_id',$item->uom_id) ? 'selected' : '' }} value="{{ $uom->id }}">{{ $uom->name }} </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">OEM</label>
                                <select class="form-control" name="oem_id">
                                    @foreach ($oems as $oem)
                                        <option {{ $oem->id == old('pm_id',$item->oem_id) ? 'selected' : '' }} value="{{ $oem->id }}">{{ $oem->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">GL Type</label>
                                <select class="form-control" name="gl_type">
                                    @foreach ($gl_types as $gl_type)
                                        <option {{ $gl_type->gl_type == old('pm_id',$item->gl_type) ? 'selected' : '' }} value="{{ $gl_type->gl_type }}">{{ $gl_type->name }} </option>
                                    @endforeach
                                </select>
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

