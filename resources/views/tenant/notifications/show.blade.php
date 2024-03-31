@extends('layouts.app')
@section('title','View Notification')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('notifications.index') }}">Notification</a></li>
	<li class="breadcrumb-item active">{{ $notification->data['subject'] }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Notification
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Notification"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-10">
			<div class="card">
				{{-- <div class="card-header">
					<h5 class="card-title">Notification Info</h5>
				</div> --}}
				<div class="card-body">
					
					<h4><i data-feather="bell" class="fea text-secondary"></i>{{ $notification->data['subject'] }}</h4>
					<span class="text-xs">
						From: {{ $notification->data['from'] }} 
						<br>
						<small>at {{ strtoupper(date('d-M-Y H:i:s', strtotime($notification->created_at))) }}</small>
					</span>
					<hr>
					{{-- <p>&nbsp;</p> --}}
					<p><strong>{{ $notification->data['greeting'] }}</strong></p>
					{{-- <p>&nbsp;</p> --}}
					<p>{{ $notification->data['body'] }}</p>
					<a class="btn btn-info" href="{{ $notification->data['actionURL'] }}"><i data-feather="eye"></i> {{ $notification->data['actionText'] }}</a>
					<p>&nbsp;</p>
					<p>{{ $notification->data['thanks'] }}</p>
					{{-- <p>&nbsp;</p> --}}
					<span>
						Thank you, </br>
						{{ config('app.name') }} Team</br>
						@if ($notification->read_at <> "")
						<small class="text-muted"> Read At: {{ $notification->read_at }}</small>
						@endif
					</span>

					{{-- <p class=""><small class="text-muted">{{ $ticket->content }}</small></p>
					<p class="text-xs"><small class="text-muted">Created By: {{ $ticket->owner->name }}</small><small class="text-muted"> on : {{ $ticket->ticket_date }}</small></p>
					<p class=""><small class="text-muted">Attachment: <x-landlord.attachment.list-one  entity="{{ $entity }}" aid="{{ $ticket->id }}"/></small></p> --}}
					<hr>
					<div class="float-end mt-n1">
						<a class="btn btn-primary" href="{{ route('notifications.index') }}"><i data-feather="list"></i> Notifications List</a>
					</div>
					@if ( $notification->read_at == "")
					<a class="btn btn-success" href="{{ route('notifications.read',$notification->id) }}"><i data-feather="check-circle"></i> Mark as Read</a>
					@endif
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-4">

		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

