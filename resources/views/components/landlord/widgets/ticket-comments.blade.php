<div class="card">
	<div class="card-header">
		<h5 class="card-title mb-0">Comments #{{ $ticket->id }}: {{ $ticket->title }}</h5>
	</div>
	<div class="card-body">

		@foreach ($comments as $comment)
			<div class="d-flex align-items-start">
				@if ($comment->by_back_office)
					@if (auth()->user()->isSeeded())
						<img src="{{ Storage::disk('s3l')->url('avatar/'.$comment->owner->avatar) }}" width="56" height="56" class="rounded-circle me-3" alt="{{ $comment->owner->name }}" title="{{ $comment->owner->name }}">
					@else
						<img src="{{ Storage::disk('s3l')->url('avatar/avatarb.png') }}" width="56" height="56" class="rounded-circle me-3" alt="Support Engineer" title="Support Engineer">
					@endif
				@else
					<img src="{{ Storage::disk('s3l')->url('avatar/'.$comment->owner->avatar) }}" width="56" height="56" class="rounded-circle me-3" alt="{{ $comment->owner->name }}" title="{{ $comment->owner->name }}">
				@endif

				<div class="flex-grow-1">
					<small class="float-end">
						@php
							$timeAgo = Carbon\Carbon::parse($comment->comment_date)->ago();
						@endphp
						{{ $timeAgo }}
					</small>
					<p class="mb-2">
						<strong>
							@if ($comment->by_back_office)
								@if (auth()->user()->isSeeded())
									{{ $comment->owner->name }}
								@else
									Support Engineer
								@endif
							@else
								{{ $comment->owner->name }}
							@endif
						</strong>
					</p>

					@if ( $comment->is_internal )
						<p>
							<span class="badge bg-danger">INTERNAL</span> {!! nl2br($comment->content) !!}
						</p>
					@else
						<p>{!! nl2br($comment->content) !!}</p>
					@endif
					<small class="text-muted">{{ strtoupper(date('d-M-Y H:i:s', strtotime($comment->comment_date ))) }}</small><br />
					@if ($comment->attachment_id <> '')
						<small class="text-muted">Attachment: <x-landlord.attachment.show-by-id attachmentId="{{ $comment->attachment_id }}"/></small><br />
					@endif
				</div>
			</div>
			@if (! $loop->last)
				<hr />
			@endif

		@endforeach

	</div>
</div>





