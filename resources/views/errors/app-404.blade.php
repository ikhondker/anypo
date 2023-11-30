@extends('layouts.app')
@section('title','404')

@section('content')

    <x-page-header>
        @slot('title')
            404
        @endslot
        @slot('buttons')
            
        @endslot
    </x-page-header>

    <div class="row">
        <div class="col-8">

            I AM HERE!
            

        </div>
         <!-- end col -->
    </div>
     <!-- end row -->

       

@endsection

