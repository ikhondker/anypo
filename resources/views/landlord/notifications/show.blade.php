@extends('layouts.landlord-app')
@section('title','Notification')
@section('breadcrumb','View Notifications')


@section('content')

    <!-- my-section-row -->
    <div class="row my-section-row justify-content-between">
        <div class="col-xl-12">
            <h4><i data-feather="mail" class="fea text-primary"></i> {{ $notification->data['subject'] }}</h4>

            <p class="text-xs">From: {{ $notification->data['from'] }} at  {{ strtoupper(date('d-M-Y H:i:s', strtotime($notification->created_at))) }}</p>
            <p>&nbsp;</p>
            <p><strong>{{ $notification->data['greeting'] }}</strong></p>
            <p>&nbsp;</p>
            <p>{{ $notification->data['body'] }}</p>
            <p>&nbsp;</p>
            <a class="btn btn-info" href="{{ $notification->data['actionURL'] }}">{{ $notification->data['actionText'] }}</a>
            <p>&nbsp;</p>
            <p>{{ $notification->data['thanks'] }}</p>
            <p>&nbsp;</p>
            <p>Thank you, </p>
            <p>{{ config('app.name') }} Team</p>
            <p class="mt-4"><small class="text-muted"> Read At: {{ $notification->read_at }} </small></p>

            {{-- <p class=""><small class="text-muted">{{ $ticket->content }}</small></p>
            <p class="text-xs"><small class="text-muted">Created By: {{ $ticket->owner->name }}</small><small class="text-muted"> on : {{ $ticket->ticket_date }}</small></p>
            <p class=""><small class="text-muted">Attachment: <x-landlord.attachment.list-one  entity="{{ $entity }}" aid="{{ $ticket->id }}"/></small></p> --}}

        </div>
    </div>
    <!-- /.my-section-row -->

    <div class="my-section-buttons">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-info" href="{{ route('notifications.read',$notification->id) }}">Mark as Read</a>
        </div>
    </div>


        
       
@endsection

