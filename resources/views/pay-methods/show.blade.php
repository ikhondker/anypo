@extends('layouts.app')
@section('title','View PayMethod')

@section('content')

    <x-page-header>
        @slot('title')
            View PayMethod
        @endslot
        @slot('buttons')
            <x-buttons.header.lists object="PayMethod"/>
            <x-buttons.header.create object="PayMethod"/>
            <x-buttons.header.edit object="PayMethod" :id="$payMethod->id"/>
        @endslot
    </x-page-header>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">PayMethod Info</h5>
                </div>
                <div class="card-body">
                    <x-show.my-text     value="{{ $payMethod->name }}"/>
                    <x-show.my-text     value="{{ $payMethod->pay_method_number }}" label="Number"/>
                    <div class="row mb-3">
                        <div class="col-sm-3 text-end">
                            <span class="h6 text-secondary">Currency:</span>
                        </div>
                        <div class="col-sm-9">
                            {{ $payMethod->currency }} <x-info info="Note: You wont be able to change the currency."/>
                        </div>
                    </div>
                    <x-show.my-text     value="{{ $payMethod->bank_name }}" label="Bank Name"/>
                    <x-show.my-text     value="{{ $payMethod->branch_name }}" label="Branch Name"/>
                    <x-show.my-badge    value="{{ $payMethod->id }}" label="ID"/>
                    <x-show.my-boolean  value="{{ $payMethod->enable }}"/>
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
                    <x-show.my-date     value="{{ $payMethod->start_date }}" label="Start"/>
                    <x-show.my-date     value="{{ $payMethod->end_date }}" label="End"/>
                </div>
            </div>
        </div>
        <!-- end col-6 -->
    </div>
    <!-- end row -->

@endsection

