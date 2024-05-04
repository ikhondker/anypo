@extends('layouts.landlord-app')
@section('title','Attachments')
@section('breadcrumb','Attachments')


@section('content')


	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">All Attachments</h5>
			<a class="btn btn-primary btn-sm" href="{{ route('attachments.create') }}">
				<i class="bi bi-plus-square me-1"></i> Create Attachment
			</a>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
				<tr>
					<th>&nbsp; &nbsp; Subject</th>
					<th>Date</th>
					<th>Type</th>
					<th>Size</th>
					<th>File</th>
					<th style="width: 5%;">Action</th>
				</tr>
				</thead>

				<tbody>
					@foreach ($attachments as $attachment)
						<tr>
							<td>
								<div class="flex-grow-1 ms-3">
									<a class="d-inline-block link-dark" href="{{ route('attachments.show',$attachment->id) }}">
										<h6 class="text-hover-primary mb-0">[#{{ $attachment->id }}] {{ $attachment->entity }}</h6>
									</a>
									<small class="d-block">{{ $attachment->owner->name }}</small>
								</div>
							</td>
							<td><x-landlord.list.my-date :value="$attachment->upload_date"/></td>
							<td>{{ Str::limit($attachment->file_type, 15) }}</td>
							<td>{{ number_format($attachment->file_size / 1048576,2) }}</td>
							<td><x-landlord.attachment.show-by-id id="{{ $attachment->id }}"/></td>
							<td><x-landlord.list.actions object="Attachment" :id="$attachment->id"/></td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
		<!-- End Table -->

		<!-- card-body -->
		<div class="card-body">
			<!-- pagination -->
			{{ $attachments->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

@endsection

