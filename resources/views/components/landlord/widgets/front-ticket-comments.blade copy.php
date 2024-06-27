<div class="card">
	<div class="card-header">
		<h5 class="card-title mb-0">Comments #{{ $ticket->id }}: {{ $ticket->title }}</h5>
	</div>
	<div class="card-body">

		@foreach ($comments as $comment)
			<div class="d-flex align-items-start">
				@if ($comment->by_backoffice)
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
							@if ($comment->by_backoffice)
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
						<small class="text-muted">Attachment: <x-landlord.attachment.show-by-id id="{{ $comment->attachment_id }}"/></small><br />
					@endif
				</div>
			</div>
			@if (! $loop->last)
				<hr />
    		@endif

		@endforeach
		
	</div>
</div>



	<!-- Comment -->
	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom bg-secondary-subtle">
			<h4 class="card-header-title text-info">History #{{ $ticket->id }}: {{ $ticket->title }}</h4>
		</div>

		<!-- Body -->
		<div class="card-body">
			<div class="row">
				<div class="col-lg-10">
					<!-- Comment -->
					<ul class="list-comment">
						@foreach ($comments as $comment)

							<!-- Item -->
							<li class="list-comment-item">
								<!-- Media -->
								<div class="d-flex mb-3">
									<div class="flex-shrink-0">
										@if ($comment->by_backoffice)
											@if (auth()->user()->isSeeded())
												<img class="avatar avatar-circle" src="{{ Storage::disk('s3l')->url('avatar/'.$comment->owner->avatar) }}" alt="{{ $comment->owner->name }}" title="{{ $comment->owner->name }}">
											@else
												<img class="avatar avatar-circle" src="{{ Storage::disk('s3l')->url('avatar/avatarb.png') }}" alt="Support Engineer" title="Support Engineer">
											@endif
										@else
											<img class="avatar avatar-circle" src="{{ Storage::disk('s3l')->url('avatar/'.$comment->owner->avatar) }}" alt="{{ $comment->owner->name }}" title="{{ $comment->owner->name }}">
										@endif
									</div>
									<div class="flex-grow-1 ms-3">
										@if ($comment->by_backoffice)
											@if (auth()->user()->isSeeded())
												<h5>{{ $comment->owner->name }}</h5>
											@else
												<h5>Support Engineer</h5>
											@endif
										@else
											<h5>{{ $comment->owner->name }}</h5>
										@endif
										<div class="d-flex align-items-center mb-3">
											@php
												$timeAgo = Carbon\Carbon::parse($comment->comment_date)->ago();
											@endphp
											<span class="d-block small text-muted">{{ $timeAgo }}</span>
											{{-- <small class="d-block">on November 12, 2020</small> --}}
										</div>

										{{-- <h5>Fun place to work at</h5> --}}
										@if ( $comment->is_internal )
											<p>
												<span class="badge bg-danger">INTERNAL</span> {{ $comment->content }}
											</p>
										@else
											<p>{!! nl2br($comment->content) !!}</p>
										@endif
										@if ($comment->attachment_id <> '')
											<p class="small text-muted">Attachment: <x-landlord.attachment.show-by-id id="{{ $comment->attachment_id }}"/></p>
										@endif

									</div>
								</div>
								<!-- End Media -->
							</li>
							<!-- End Item -->

						@endforeach

					</ul>
					<!-- End Comment -->
				</div>
				<!-- End Col -->
			</div>
			<!-- End Row -->

		</div>
		<!-- End Body -->

	</div>
	<!-- End Card -->
<!-- End Comment -->




