@extends('layouts.app')
@section('title','Dept')

@section('content')

    <x-page-header>
        @slot('title')
            Departments
        @endslot
        @slot('buttons')
            <x-buttons.header.create object="Dept"/>
        @endslot
    </x-page-header>

    <div class="row">
        <div class="col-8">

            @livewire('index.dept-index')

        </div>
         <!-- end col -->
    </div>
     <!-- end row -->

     {{-- @include('includes.modal-boolean-advance')     --}}

@endsection

