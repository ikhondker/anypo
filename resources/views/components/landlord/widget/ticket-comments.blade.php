<p></p>
<!-- Comment -->
	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Ticket History #{{ $ticket->id }}</h4>
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
											@if (auth()->user()->isFrontOffice())
												<img class="avatar avatar-circle" src="{{ asset('/assets/avatar/avatarb.png') }}" alt="Support Engineer" title="Support Engineer">
											@else
												<img class="avatar avatar-circle" src="{{ url(config('bo.DIR_AVATAR').$comment->owner->avatar) }}" alt="{{ $comment->owner->name }}" title="{{ $comment->owner->name }}">
											@endif
										@else
											<img class="avatar avatar-circle" src="{{ url(config('bo.DIR_AVATAR').$comment->owner->avatar) }}" alt="{{ $comment->owner->name }}" title="{{ $comment->owner->name }}">
										@endif
								  	</div>
									<div class="flex-grow-1 ms-3">
										@if ($comment->by_backoffice)
											@if (auth()->user()->isFrontOffice())
												<h5>Support Engineer</h5>
											@else
												<h5>{{ $comment->owner->name }}</h5>
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
											<p class="text-danger">INTERNAL: {{ $comment->content }}</p>
										@else
											<p>{{ $comment->content }}</p>
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




