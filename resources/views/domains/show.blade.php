@extends('layouts.landlord.app')
@section('title','Domain Detail')
@section('breadcrumb','Domain Detail')

@section('content')
	<div class="d-grid gap-3 gap-lg-5">
		<!-- Card -->
		<div class="card">
			<div class="card-header border-bottom">
					<h4 class="card-header-title">Domain Info (TODO P2)</h4>
			</div>

			<!-- Body -->
			<div class="card-body">

					<!-- Form -->
					<div class="row mb-4">
							<label class="col-sm-3 col-form-label form-label">Domain Logo</label>

							<div class="col-sm-9">
								<!-- Media -->
								<div class="d-flex align-items-center">
								<!-- Avatar -->
								<label class="avatar avatar-xl avatar-circle" for="avatarUploader">
									<img id="avatarImg" class="avatar-img" src="{{ asset('/assets/img/160x160/img9.jpg') }}" alt="Image Description">
								</label>

								<div class="d-grid d-sm-flex gap-2 ms-4">
									<div class="form-attachment-btn btn btn-primary btn-sm">Upload photo
										<input type="file" class="js-file-attach form-attachment-btn-label" id="avatarUploader"
													data-hs-file-attach-options='{
															"textTarget": "#avatarImg",
															"mode": "image",
															"targetAttr": "src",
															"resetTarget": ".js-file-attach-reset-img",
															"resetImg": "./assets/img/160x160/img1.jpg",
															"allowTypes": [".png", ".jpeg", ".jpg"]
													}'>
									</div>
									<!-- End Avatar -->
								</div>
								</div>
								<!-- End Media -->
							</div>
					</div>
					<!-- End Form -->
					<x-landlord.show.my-badge	value="{{ $domain->id }}" label="ID"/>
					<x-landlord.show.my-badge	value="{{ $domain->tenant_id }}" label="Tenant"/>
					<x-landlord.show.my-text	value="{{ $domain->domain }}" label="Domain"/>
					<x-landlord.show.my-date	value="{{ $domain->created_at }}"/>
			</div>
			<!-- End Body -->

			<!-- Footer -->
			<div class="card-footer pt-0">
					<div class="d-flex justify-content-end gap-3">
							<a class="btn btn-primary" href="{{ route('tenants.edit',$domain->id) }}">Edit</a>
					</div>
			</div>
			<!-- End Footer -->
		</div>
		<!-- End Card -->


		<!-- Card -->
		<div class="card">
			<div class="card-header">
				<h5 class="card-header-title">All Users: {{ $domain->tenant_id }}</h5>
			</div>

			<!-- Table -->
			<div class="table-responsive">
				<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
					<thead class="thead-light">
						<tr>
							<th>User</th>
							<th>ID</th>
							<th>Domain</th>
							<th>Date</th>
							<th>Status</th>
							<th style="width: 5%;">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td>
							<div class="d-flex align-items-center">
								<div class="flex-shrink-0">
									<img class="avatar avatar-sm avatar-circle" src="{{ asset('/assets/logo/logo.png') }}" alt="Logo">
								</div>

								<div class="flex-grow-1 ms-3">
									<a class="d-inline-block link-dark" href="#">
										<h6 class="text-hover-primary mb-0">{{ $user->name }}</h6>
									</a>
								<small class="d-block">{{ $user->email }}</small>
								</div>
							</div>
							</td>
							<td>{{ $user->id }} </td>
							<td>{{ $user->role }}</td>
							<td>x</td>
							<td>x</td>
							<td>x</td>
						</tr>

						@endforeach
					</tbody>


				</table>
			</div>
			<!-- End Table -->


		</div>
		<!-- End Card -->
	</div>
@endsection

