@extends('layouts.app')
@section('title','View Template ')
@section('breadcrumb','View Templates v1.3 (8-MAY-23)')

@section('content')

    <x-tenant.page-header>
        @slot('title')
            View Template
        @endslot
        @slot('buttons')
            <x-tenant.buttons.header.lists object="Template"/>
            <a href="{{ route('templates.create') }}" class="btn btn-primary float-end me-2"><i class="fas fa-plus"></i> New Template</a>
            <a href="{{ route('templates.edit',$template->id) }}" class="btn btn-primary float-end me-2"><i class="fas fa-edit"></i> Edit Template</a>
            <a href="{{ route('templates.index') }}" class="btn btn-primary float-end me-2"><i class="fas fa-plus"></i> Template List</a>
        @endslot
    </x-tenant.page-header>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Basic Info</h5>
                    <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-text     value="{{ $template->code }}" label="CODE"/>
                    <x-tenant.show.my-text     value="{{ $template->summary }}" label="Summary"/>
                    <x-tenant.show.my-text     value="{{ $template->name }}"/>
                    <x-tenant.show.my-text     value="{{ $template->email }}" label="E-mail"/>
                    <x-tenant.show.my-text     value="{{ $template->phone }}" label="Phone"/>
                    <x-tenant.show.my-text     value="{{ $template->user->name  }}" label="User Name"/>
                    <x-tenant.show.my-badge    value="{{ $template->my_enum }}" label="Enum/Role:"/>
                    <x-tenant.show.my-boolean  value="{{ $template->enable }}"/>
                    <x-tenant.show.my-badge    value="{{ $template->id }}" label="ID"/>
                    {{-- <x-button.edit object="Template" :id="$template->id"/> --}}
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Address</h5>
                    <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-text value="{{ $template->address1 }}" label="Address1"/>
                    <x-tenant.show.my-text value="{{ $template->address2 }}" label="Address2"/>
                    <x-tenant.show.my-text value="{{ $template->zip }}" label="Zip"/>
                    <x-tenant.show.my-text value="{{ $template->state }}" label="state"/>
                    <x-tenant.show.my-integer value="{{ $template->qty }}" label="Qty"/>                                
                    <x-tenant.show.my-number value="{{ $template->amount }}" label="Amount"/>            
                    {{-- <x-button.edit object="Template" :id="$template->id"/> --}}
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Basic Info</h5>
                    <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 text-end">
                           <span class="h6 text-secondary">Photo:</span>
                        </div>
                        <div class="col-sm-9">
                            @if ( $template->image <> '')
                                <img src="{{ url('template/'.$template->image) }}" width="100px"> 
                            @else
                                <img src="{{asset('/logo/logo.png')}}" width="120px"> 
                            @endif
                        </div>
                     </div>                    
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Others</h5>
                    <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
                </div>
                <div class="card-body">
                    <x-tenant.show.my-boolean   value="{{ $template->enable }}" label="Boolean"/>
                    <x-tenant.show.my-date  value="{{ $template->my_date }}" label="Date"/>
                    <x-tenant.show.my-date-time value="{{ $template->my_date_time }}" label="DateTime"/>           
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
