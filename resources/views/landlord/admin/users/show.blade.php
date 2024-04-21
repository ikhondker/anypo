@extends('layouts.landlord-app')
@section('title', 'Users')
@section('breadcrumb', 'User Profile')

@section('content')
	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h4 class="card-header-title">User Profile</h4>
			<a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
				<i class="bi bi-pencil-square me-1"></i> Edit Profile
			</a>
		</div>

		<!-- Body -->
		<div class="card-body">
			
			<!-- Form -->
			<div class="row mb-4">
				<label class="col-sm-3 col-form-label form-label">Profile Photo :</label>

				<div class="col-sm-9">

					<!-- Media -->
					<div class="d-flex align-items-center">
						<!-- Avatar -->
						<label class="avatar avatar-xxl avatar-circle" for="avatarUploader">
							<img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3l')->url('avatar/'.$user->avatar) }}" alt="{{ $user->name }}" title="{{ $user->name }}">
						</label>
						<div class="d-grid d-sm-flex gap-2 ms-4">

						</div>
						<!-- End Avatar -->
					</div>
					<!-- End Media -->

				</div>
			</div>
			<!-- End Form -->

			<x-landlord.show.my-text value="{{ $user->name }}" />
			<x-landlord.show.my-text value="{{ $user->email }}" label="E-mail"/>
			<x-landlord.show.my-text value="{{ $user->cell }}" label="Cell"/>
			<x-landlord.show.my-badge value="{{ $user->role }}" label="Role"/>
			
			<x-landlord.show.my-text value="{{ $user->account->name }}" label="Account"/>

			<x-landlord.show.my-text value="{{ $user->address1 }}" label="Address1"/>
			<x-landlord.show.my-text value="{{ $user->address2 }}" label="Address2"/>
			<x-landlord.show.my-text value="{{ $user->city . ', ' . $user->state . ', ' . $user->zip }}" label="City-State-Zip"/>
			<x-landlord.show.my-text value="{{ $user->user_country->name }}" label="Country" />
			<x-landlord.show.my-date-time value="{{ $user->email_verified_at }}" label="Email Verified At" />
			<x-landlord.show.my-enable value="{{ $user->enable }}" />
			@if (auth()->user()->isSeeded())
				<x-landlord.show.my-enable value="{{ $user->seeded }}" label="Seeded" />
			@endif
		</div>
		<!-- End Body -->

		<!-- Footer -->
		<div class="card-footer pt-0">
			<div class="d-flex justify-content-end gap-3">
				<a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
					<i class="bi bi-pencil-square me-1"></i> Edit Profile
				</a>
			</div>
		</div>
		<!-- End Footer -->
	</div>
	<!-- End Card -->
@endsection

