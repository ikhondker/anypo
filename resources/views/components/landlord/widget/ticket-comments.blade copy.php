<p></p>
<!-- Comment -->
	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Ticket Updates #{{ $ticket->id }}</h4>
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
								<div class="d-flex align-items-center mb-3">
									<div class="flex-shrink-0">
										<img class="avatar avatar-circle" src="{{ url(config('bo.DIR_AVATAR').$comment->owner->avatar) }}" alt="{{ $comment->owner->name }}" title="{{ $comment->owner->name }}">
									</div>

									<div class="flex-grow-1 ms-3">
										<div class="d-flex justify-content-between align-items-center">
											<h6>{{ $comment->owner->name }}</h6>
											@php
												$timeAgo = Carbon\Carbon::parse($comment->comment_date)->ago();
											@endphp
											<span class="d-block small text-muted">{{ $timeAgo }}</span>
										</div>
									</div>

								</div>
								<!-- End Media -->

								@if ( $comment->is_internal )
									<p class="text-danger">INTERNAL: {{ $comment->content }}</p>
								@else 
									<p>{{ $comment->content }}</p>
								@endif

								{{-- <p class="small text-muted">At {{ strtoupper(date('d-M-Y H:i:s', strtotime($comment->comment_date ))) }} by {{ $comment->owner->name  }}</p> --}}
								@if ($comment->attachment_id <> '')
									<p class="small text-muted">Attachment: <x-landlord.attachment.show-by-id id="{{ $comment->attachment_id }}"/></p>
								@endif

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




