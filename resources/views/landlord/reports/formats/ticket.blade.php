@extends('layouts.landlord.pdf-portrait', ['thanks' => false])
@section('title','Ticket')

@section('header')
	<div id="details" class="clearfix">
		<div id="client">
			<div class="to">REQUESTOR :</div>
			<h2 class="name">{{ $owner->name }}</h2>
			<div class="address">Email :{{ $owner->email }}</div>
			<div class="address">Cell :{{ $owner->cell }}</div>
			{{-- <div class="address">{{ $owner->address1.', '. $owner->address2 }}</div> --}}
			{{-- <div class="address">{{ $owner->city.', '.$owner->state.', '.$owner->zip. ', '.$owner->country }}</div> --}}
			{{-- <div class="address">796 Silver Harbour, TX 79273, US</div>
			<div class="email">you@example.com</div> --}}
		</div>
		<div id="invoice">
			<h1>TICKET #{{ $ticket->id}}</h1>
			<div class="date">Date: {{ strtoupper(date('d-M-Y', strtotime($ticket->ticket_date))) }}</div>
			<div class="date">Status: {{ Str::upper($ticket->status->name) }} </div>
		</div>
	</div>
@endsection

@section('content')
	<hr />
	<div id="notices">
		<h3>#{{ $ticket->id}} : {{ $ticket->title}}</h3>
		<p>{{ $ticket->content}}</p>
		<small class="text-muted">Attachment: <x-landlord.attachment.show-by-id attachmentId="{{ $ticket->attachment_id }}"/></small><br />
		<hr />
	</div>

	<div class="card">
		<div class="card-body">
			@foreach ($comments as $comment)
				<div class="d-flex align-items-start">
					<div class="flex-grow-1">
						@if ( $comment->is_internal )
							<p><span class="badge bg-danger">INTERNAL</span> {!! nl2br($comment->content) !!}</p>
						@else
							<p>{!! nl2br($comment->content) !!}</p>
						@endif

						<small class="text-muted">
							@if ($comment->by_back_office)
								@if (auth()->user()->isSeeded())
									{{ $comment->owner->name }}
								@else
									Support Engineer
								@endif
							@else
								{{ $comment->owner->name }}
							@endif
							: {{ strtoupper(date('d-M-Y H:i:s', strtotime($comment->comment_date ))) }}
						</small>
						<br />

						@if ($comment->attachment_id <> '')
							<small class="text-muted">Attachment: <x-landlord.attachment.show-by-id attachmentId="{{ $comment->attachment_id }}"/></small><br />
						@endif
					</div>
				</div>
				<hr />
			@endforeach
		</div>
	</div>

@endsection

