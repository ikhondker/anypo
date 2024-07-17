@extends('layouts.tenant.app')
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
			<x-tenant.actions.notification.notification-actions :id="$notification->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-body">
			<div>
				<div class="card-actions float-end">
					@if ( $notification->read_at == "")
						<a class="btn btn-sm btn-light me-2" href="{{ route('notifications.read',$notification->id) }}"><i data-lucide="check-circle"></i> Mark as Read</a>
					@endif
					<a href="{{ route('notifications.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
				</div>
				
				<h5 class="card-title">{{ $notification->data['subject'] }}</h5>
				<hr>

				<div class="d-flex">
					<img width="40" height="40" src="{{ Storage::disk('s3t')->url('logo/logo.png') }}" class="rounded-circle d-flex me-2" alt="Logo">
					<div class="w-100 mt-1">
						<small class="float-end">{{ date('F d, Y H:i A', strtotime($notification->created_at)) }}</small>
						<h6 class="mb-0">{{ $notification->data['from'] }} </h6>
						<small class="text-muted">from: workflow@anypo.com</small><br>
					</div>
				</div>
				<div class="mx-5 my-3">
					<p>{{ $notification->data['greeting'] }},</p>
					{{-- <p>We hope this email finds you well.</p> --}}
					<p>{{ $notification->data['body'] }}.</p>
					<p><a class="btn btn-info" href="{{ $notification->data['actionURL'] }}"><i data-lucide="eye"></i> {{ $notification->data['actionText'] }}</a></p>
					<p>&nbsp;</p>
					<p>{{ $notification->data['thanks'] }}</p>
					<p>Thank you, </br>
					{{ config('app.name') }} Team</br></p>
					@if ($notification->read_at <> "")
						<small class="text-muted"> Read At: {{ $notification->read_at }}</small>
					@endif
				</div>

				<hr />
				<div class="btn-toolbar">
					@if ( $notification->read_at == "")
						<a class="btn btn-light me-2" href="{{ route('notifications.read',$notification->id) }}"><i data-lucide="check-circle"></i> Mark as Read</a>
					@endif
				</div>
			</div>

		</div>
	</div>

@endsection

