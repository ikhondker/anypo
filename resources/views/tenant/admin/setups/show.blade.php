@extends('layouts.app')
@section('title','Setup')

@section('content')

    <x-page-header>
        @slot('title')
            Setup
        @endslot
        @slot('buttons')
            <a href="{{ route('setups.notice',$setup->id) }}" class="btn btn-primary float-end me-2"><i class="fas fa-edit"></i> Notice</a>
            <x-buttons.header.edit object="Setup" :id="$setup->id"/>
        @endslot
    </x-page-header>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Basic Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text     value="{{ $setup->name }}"/>
                    <x-show.my-text     value="{{ $setup->tagline }}" label="Tagline"/>
                    <x-show.my-text     value="{{ $setup->admin_user->name }}" label="Admin"/>
                    <x-show.my-boolean  value="{{ $setup->freezed }}" label="Setup freezed"/>
                    <x-show.my-boolean  value="{{ $setup->enable }}"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Financial</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 text-end">
                           <span class="h6 text-secondary">Currency:</span>
                        </div>
                        <div class="col-sm-9">
                           {{ $setup->currency.' - '.$setup->relCurrency->name.' ('.$setup->relCurrency->country.')' }} <x-info info="Note: You wont be able to change the currency."/>
                        </div>
                    </div>
                    <x-show.my-number value="{{ $setup->tax }}" label="Tax %"/>
                    <x-show.my-number value="{{ $setup->vat }}" label="VAT %"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Web Presence</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text value="{{ $setup->email }}" label="E-mail"/>
                    <x-show.my-url  value="{{ $setup->website }}" label="Website"/>
                    <x-show.my-url  value="{{ $setup->facebook }}" label="Facebook"/>
                    <x-show.my-url  value="{{ $setup->linkedin }}" label="LinkedIn"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Address</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text value="{{ $setup->address1 }}" label="Address1"/>
                    <x-show.my-text value="{{ $setup->address2 }}" label="Address2"/>
                    <x-show.my-text value="{{ $setup->city.', '.$setup->state.', '.$setup->zip  }}" label="City"/>    
                    <x-show.my-text value="{{ $setup->country_name->name }}" label="Country"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Company Logo (90x90)</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3 text-end">
                           <span class="h6 text-secondary">Logo:</span>
                        </div>
                        <div class="col-sm-9">
                            <x-show.logo logo="{{ $setup->logo }}"/>
                        </div>
                     </div>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Notice</h5>
                </div>
                <div class="card-body">
                    <x-show.my-boolean   value="{{ $setup->show_notice }}" label="Show Notice?"/>
                    <x-show.my-text value="{{ $setup->notice }}" label="Notice Text"/>
                    <x-show.my-text value="{{ $setup->cell }}" label="Cell"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

@endsection

