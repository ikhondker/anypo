@extends('layouts.app')
@section('title','View Item')

@section('content')

    <x-page-header>
        @slot('title')
            View Item
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="UploadItem"/>
            <x-buttons.header.edit object="UploadItem" :id="$uploadItem->id"/>
        @endslot
    </x-page-header>
    
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Item Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text     value="{{ $uploadItem->name }}"/>
                    <x-show.my-text     value="{{ $uploadItem->category }}" label="Category"/>
                    <x-show.my-text     value="{{ $uploadItem->oem }}" label="OEM"/>
                    <x-show.my-text     value="{{ $uploadItem->uom }}" label="UoM"/>
                    <x-show.my-number   value="{{ $uploadItem->price }}" label="Price"/>
                    <x-show.my-text     value="{{ $uploadItem->owner->name }}" label="Upload By"/>
                    <x-show.my-badge    value="{{ $uploadItem->id }}" label="ID"/>
                    <x-show.my-badge    value="{{ $uploadItem->status }}" label="Status"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Supporting Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text     value="{{ $uploadItem->category_id }}" label="Category ID"/>
                    <x-show.my-text     value="{{ $uploadItem->uom_id }}" label="UoM ID"/>
                    <x-show.my-text     value="{{ $uploadItem->oem_id }}" label="OEM ID"/>
                    <x-show.my-date-time value="{{$uploadItem->created_at }}" label="Created At"/>
                    <x-show.my-date-time value="{{$uploadItem->updated_at }}" label="Updated At"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

@endsection

