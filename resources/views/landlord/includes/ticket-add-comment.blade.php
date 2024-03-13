<!-- Card -->
<div class="card">
	<div class="card-header border-bottom">
		<h4 class="card-header-title">Add Update on Ticket #{{ $ticket->id }}</h4>
	</div>

	<!-- Body -->
	<div class="card-body">
		<!-- form start -->
		<form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticket->id }}">

			<!-- Form -->
			<div class="row mb-4">
				<label for="content" class="col-sm-3 col-form-label form-label">Content :</label>
				<div class="col-sm-9">
					<textarea class="form-control" rows="4" name="content" placeholder="Ticket Update ...">{{ old('content', 'Ticket Update ...') }}</textarea>
					@error('content')
						<div class="text-danger text-xs">{{ $message }}</div>
					@enderror
				</div>
			</div>
			<!-- End Form -->

			<!-- Form -->
			<div class="row mb-4">
				<label for="content" class="col-sm-3 col-form-label form-label">Attachment :</label>
				<div class="col-sm-9">
					<x-landlord.attachment.create />
				</div>
			</div>
			<!-- End Form -->

			@if (auth()->user()->isSeeded())
				<!-- Form -->
				<div class="row mb-4">
					<label for="status_code" class="col-sm-3 col-form-label form-label">Status :</label>
					<div class="col-sm-9">
						<select class="form-control" name="status_code">
							<option value="in-progress" {{ 'in-progress' == old('status_code') 	? 'selected' : '' }}>In Progress</option>
							<option value="development" {{ 'development' == old('status_code') 	? 'selected' : '' }}>Development</option>
							<option value="bug-fixing" 	{{ 'bug-fixing' == old('status_code') 	? 'selected' : '' }}>Bug Fixing</option>
							<option value="cwip" 		{{ 'cwip' == old('status_code') 		? 'selected' : '' }}>Customer Working</option>
							<option value="on-hold" 	{{ 'on-hold' == old('status_code') 		? 'selected' : '' }}>On-Hold</option>
						</select>
					</div>
				</div>
				<div class="row mb-4">
					<label for="status_code" class="col-sm-3 col-form-label form-label">Type of Update :</label>
					<div class="col-sm-9">
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
					</div>
				</div>
				<!-- End Form -->
			@endif

			<!-- Form -->
			<div class="row mb-4">
				<label for="status_code" class="col-sm-3 col-form-label form-label"></label>
				<div class="col-sm-9">
					<button type="submit" class="btn btn-info btn-sm mt-3">
						<i class="bi bi-pencil-square ms-1"></i>
						Update
					  </button>
				</div>
			</div>
			<!-- End Form -->

		</form>
		<!-- /.form end -->

	</div>
	<!-- End Body -->
</div>
<!-- End Card -->
