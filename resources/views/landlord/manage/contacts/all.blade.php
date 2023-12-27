@extends('layouts.landlord-app')
@section('title','Visitor Contact')
@section('breadcrumb','Visitor Contact')

@section('content')

	<!-- Card -->
	<div class="card">
		
		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h5 class="card-header-title">Visitor Contact</h5>
			<a class="btn btn-primary btn-sm" href="{{ route('contacts.create') }}">
				<i class="bi bi-plus-square me-1"></i> Create User
			</a>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
				<tr>
					<th>Name</th>
					<th>Date</th>
					<th>Subject</th>
					<th>Attachment</th>
					<th style="width: 5%;">Action</th>

				</tr>
				</thead>
		
				<tbody>
					@foreach ($contacts as $contact)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle" src="{{ Storage::disk('s3l')->url('avatar/avatar.png') }}" alt="Avatar">
									</div>
									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0">{{ $contact->first_name.' '.$contact->last_name }} [{{$contact->user_id}}]
												<img class="avatar avatar-xss ms-1" src="{{ asset('/assets/svg/illustrations/top-vendor.svg') }}" alt="Image Description" data-bs-toggle="tooltip" data-bs-placement="top" title="Verified contact">
											</h6>
										</a>
										<small class="d-block">{{ $contact->email }}</small>
									</div>
								</div>
							</td>
							
							<td><x-landlord.list.my-date :value="$contact->created_at"/></td>
							<td>{{ Str::limit($contact->subject,15) }}</td>
							<td><x-landlord.attachment.show-by-id id="{{ $contact->attachment_id }}"/></td>
							<td><x-landlord.list.actions object="Contact" :id="$contact->id" :export="false" :enable="false"/></td>
						</tr>
					@endforeach    
			

				</tbody>
			</table>
		</div>
		<!-- End Table -->

		<!-- card-body -->
		<div class="card-body">
			<!-- pagination -->
			{{ $contacts->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

@endsection

