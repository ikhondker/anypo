@extends('layouts.landlord-app')
@section('title','View Ticket')
@section('breadcrumb','View Ticket')

@section('content')



<div class="d-grid gap-3 gap-lg-5">

    <!-- Card -->
    <div class="card">
        <div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
            <h4 class="card-header-title">Ticket #{{ $ticket->id }}: {{ $ticket->title }}</h4>
            <div class="h3"><span class="badge bg-{{ $ticket->status->badge }}">{{ $ticket->status->name }}</span></div>
        </div>

        <!-- Body -->
        <div class="card-body">

            
            <p class="pt-0"><small class="text-dark">{{ $ticket->content }}</small></p>
            @if ($ticket->attachment_id <> '')
                <p class="small text-muted">Attachment: <x-landlord.attachment.show-by-id id="{{ $ticket->attachment_id }}"/></p>
            @endif

           
            {{-- <p class="small text-muted">{{ $ticket->owner->name }}</small><small class="text-muted"> on : {{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }}</p> --}}


            {{-- <x-landlord.show.my-badge value="{{ $ticket->status->name }}" label="Status" badge="{{ $ticket->status->badge }}"/> --}}
            {{-- <x-landlord.show.my-badge value="{{ $ticket->priority->name }}" label="Priority" badge="{{ $ticket->priority->badge }}"/>
            <x-landlord.show.my-badge value="{{ $ticket->dept->name }}" label="Dept"/> --}}
            
            {{-- <x-landlord.show.my-text  value="{{ $ticket->owner->name  }}" label="Owner"/> --}}

        </div>
        <!-- End Body -->
  
        <!-- Footer -->
        {{-- <div class="card-footer pt-0">
            <div class="d-flex justify-content-end gap-3">
                <a class="btn btn-primary" href="{{ route('tickets.edit',$ticket->id) }}">Edit</a>
            </div>
        </div> --}}
        <!-- End Footer -->

    </div>
    <!-- End Card -->

     <!-- Card -->
    <div class="card">
        {{-- <div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
            <h4 class="card-header-title">Problem Summary</h4>
        </div> --}}
        <!-- Body -->
        <div class="card-body">
                    <!-- Item -->
                    <div class="list-group-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img class="avatar avatar-xs avatar-4x3" src="{{ url(config('bo.DIR_AVATAR').$ticket->owner->avatar) }}" alt="{{ $ticket->owner->name }}" title="{{ $ticket->owner->name }}">
                            </div>
        
                            <div class="flex-grow-1 ms-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="mb-1">{{ $ticket->owner->name }}</h6>
                                        <span class="d-block small text-body">{{ strtoupper(date('d-M-Y H:i:s', strtotime($ticket->ticket_date ))) }} | {{ $ticket->dept->name }} | {{ $ticket->priority->name }}</span>
                                        
                                    </div>
                                    <!-- End Col -->
        
                                    <div class="col-auto">
                                        <!-- Form Switch -->
                                        <div class="form-check form-switch">
                                            <a class="btn btn-primary btn-sm sweet-alert2-confirm" href="{{ route('tickets.close',$ticket->id) }}">
                                                <i class="bi bi-lock" style="font-size: 1.3rem;"></i>
                                                Close Ticket
                                            </a>
                                        </div>
                                        <!-- End Form Switch -->
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                            </div>
                        </div>
                    </div>
                    <!-- End Item -->
        </div>
        <!-- End Body -->

    </div>
    <!-- End Card -->

    
    <!--  BEGIN ADD COMMENT  -->
    {{-- TODO not for closed ticket --}}
    @include('includes.landlord-ticket-add-comment')
    <!--  END ADD COMMENT  -->

    
    <!-- card-ticket-comments -->
    <x-landlord.widget.ticket-comments id="{{ $ticket->id }}"/>
    <!-- /.card-ticket-comments -->

    @include('includes.sweet-alert2-confirm')
    
</div>

@endsection


