@php
	$replyTemplates		= App\Models\Landlord\Lookup\ReplyTemplate::primary()->get();
@endphp

<div class="card">
	<div class="card-header">
		<h5 class="card-title">Add Comment</h5>
	</div>
	<div class="card-body">

		<form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">
			<table class="table table-sm my-2">
				<tbody>

					<tr>
						<th>Comment :</th>
						<td>
							<textarea class="form-control" rows="6" name="content" id="content"  placeholder="Ticket Update ...">{{ old('content', 'Ticket Update ...') }}</textarea>
							@error('content')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
						</td>
					</tr>
					<tr>
						<th>Reply Template :</th>
						<td>
							<select class="form-control select2" data-toggle="select2" name="reply_template_id" id="reply_template_id">
								<option value=""><< Reply Template >> </option>
								@foreach ($replyTemplates as $replyTemplate)
									<option value="{{ $replyTemplate->id }}" {{ $replyTemplate->id == old('reply_template_id') ? 'selected' : '' }} >{{ $replyTemplate->name }} </option>
								@endforeach
							</select>
							@error('reply_template_id')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
						</td>
					</tr>

					<tr>
						<th>Attachment :</th>
						<td>
							<x-landlord.attachment.create />
						</td>
					</tr>

					@if (auth()->user()->isSeeded())

						<tr>
							<th>Status :</th>
							<td>
								<select class="form-control" name="status_code">
									<option value="in-progress" {{ 'in-progress' == old('status_code') 	? 'selected' : '' }}>In Progress</option>
									<option value="development" {{ 'development' == old('status_code') 	? 'selected' : '' }}>Development</option>
									<option value="bug-fixing" 	{{ 'bug-fixing' == old('status_code') 	? 'selected' : '' }}>Bug Fixing</option>
									<option value="cwip" 		{{ 'cwip' == old('status_code') 		? 'selected' : '' }}>Customer Working</option>
									<option value="on-hold" 	{{ 'on-hold' == old('status_code') 		? 'selected' : '' }}>On-Hold</option>
								</select>
							</td>
						</tr>

						<tr>
							<th>Type of Update :</th>
							<td>
								<!-- List Group -->
								<div class="list-group list-group-flush list-group-no-gutters">
									<!-- Item -->
									<div class="list-group-item">
										<!-- Form Switch -->
										<label class="form-check form-switch" for="internal">
											<input class="form-check-input mt-0" type="checkbox" id="internal" name="internal">
											<span class="d-block"> Internal Update</span>
											<span class="d-block small text-danger">Careful! This update will be visible to user.</span>
										</label>
									<!-- End Form Switch -->
									</div>
									<!-- End Item -->
								</div>
								<!-- End List Group -->
							</td>
						</tr>
					@endif

				</tbody>
			</table>
			<x-landlord.create.save/>
		</form>
		<!-- Form -->
	</div>
</div>

<script type="module">
	$(document).ready(function () {
		//console.log("Inside: reply_template_id");
		$('#reply_template_id').change(function() {
			//console.log("reply_template_id changed");
			let id = $(this).val();
			let url = '{{ route("reply-templates.get-template", ":id") }}';
			url = url.replace(':id', id);
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
				// delay: 250,
				success: function(response) {
					if (response != null) {
						$('#content').val(response.notes);
					}
				}
			});
		});
	});

</script>



