@extends('layouts.app')
@section('title','All Notifications')

@section('content')

    <x-page-header>
        @slot('title')
            All Notifications
        @endslot
        @slot('buttons')
            <a href="{{ route('notifications.purge') }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-trash-can"></i> Purge Read Notification</a>
            <a href="{{ route('notifications.index') }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-message"></i> Unread Notification</a>
            {{-- <x-buttons.header.create object="Dept"/> --}}
        @endslot
    </x-page-header>


    @include('includes.notification-stat')

    <div class="row">
        <div class="col-8">

            <div class="card">
                <div class="card-header">
                    <x-cards.header-search-export-bar object="Notification" :export="false"/>
                    <h5 class="card-title">
                        @if (request('term'))
                            Search result for: <strong class="text-danger">{{ request('term') }}</strong>
                        @else
                            Notification Lists
                        @endif
                    </h5>
                    <h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
                </div>

                <div class="card-body">
                    
                    <x-notifications.all/>
                    
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

        </div>
         <!-- end col -->
    </div>
     <!-- end row -->

     

@endsection

