@extends('layouts.landlord-app')
@section('title', 'Users')
@section('breadcrumb', 'View Users')

@section('content')
	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
			<h4 class="card-header-title">User Profile</h4>
			<a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
				<i class="bi bi-pencil-square me-1"></i> Edit User
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
							<img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3la')->url($user->avatar) }}" alt="{{ $user->name }}" title="{{ $user->name }}">
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
			<x-landlord.show.my-text value="{{ $user->email }}" label="E-mail" />
			<x-landlord.show.my-text value="{{ $user->cell }}" label="Cell" />
			<x-landlord.show.my-badge value="{{ $user->role }}" label="Role" />
			
			<x-landlord.show.my-text value="{{ $user->user_account->name }}" label="Account" />

			<x-landlord.show.my-text value="{{ $user->address1 }}" label="Address1" />
			<x-landlord.show.my-text value="{{ $user->address2 }}" label="Address2" />
			<x-landlord.show.my-text value="{{ $user->city . ', ' . $user->state . ', ' . $user->zip }}" label="City-State-Zip" />
			<x-landlord.show.my-text value="{{ $user->user_country->name }}" label="Country" />
			<x-landlord.show.my-date-time value="{{ $user->email_verified_at }}" label="Email Verified At" />
			<x-landlord.show.my-enable value="{{ $user->enable }}" />


		</div>
		<!-- End Body -->

		<!-- Footer -->
		<div class="card-footer pt-0">
			<div class="d-flex justify-content-end gap-3">
				<a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
					<i class="bi bi-pencil-square me-1"></i> Edit User
				</a>
			</div>
		</div>
		<!-- End Footer -->
	</div>
	<!-- End Card -->
@endsection

@section('bo04-content')

	<x-landlord.card.header title="Users Profile" />

	{{-- <div class="p-4 border-bottom">
		<h4 class="title mb-0">User Profile</h4>
	</div> --}}

	<!-- my-section-row -->
	<div class="row my-section-row justify-content-between">
		<div class="col-xl-6">
			<h6>User Info:-</h6>
			<x-landlord.show.my-text value="{{ $user->name }}" />
			<x-landlord.show.my-text value="{{ $user->email }}" label="E-mail" />
			<x-landlord.show.my-text value="{{ $user->cell }}" label="Cell" />
			<x-landlord.show.my-badge value="{{ $user->role }}" label="Role" />
			<x-landlord.show.my-enable value="{{ $user->enable }}" />
			<x-landlord.show.my-badge value="{{ $user->id }}" label="ID" />
		</div>
		<div class="col-xl-6">
			<h6>Address:-</h6>
			<x-landlord.show.my-text value="{{ $user->address1 }}" label="Address1" />
			<x-landlord.show.my-text value="{{ $user->address2 }}" label="Address2" />
			<x-landlord.show.my-text value="{{ $user->state }}" label="State" />
			<x-landlord.show.my-text value="{{ $user->zip }}" label="Zip" />
			<x-landlord.show.my-text value="{{ $user->country }}" label="Country" />
		</div>
	</div>
	<!-- /.my-section-row -->

	<!-- my-section-row -->
	<div class="row my-section-row justify-content-between">
		<div class="col-xl-6">
			<h6>Avatar:-</h6>
			<div class="form-group row">
				<label for="name" class="col-sm-3 col-form-label col-form-label-sm text-end text-muted">Avatar:</label>
				<div class="col-sm-9 col-form-label col-form-label-sm">
					@if ($user->avatar != '')
						<img src="{{ url(config('bo.DIR_AVATAR') . $user->avatar) }}" width="90px">
					@else
						<img src="{{ url(config('bo.DIR_AVATAR') . 'avatar.png') }}" width="90px">
					@endif
				</div>
			</div>
		</div>
		<div class="col-xl-6">
			<h6>Others:-</h6>
			<x-landlord.show.my-date-time value="{{ $user->email_verified_at }}" label="Verified" />
			<x-landlord.show.my-date-time value="{{ $user->last_login_at }}" label="Last Login" />
			<x-landlord.show.my-text value="{{ $user->last_login_ip }}" label="Last IP" />
			<x-landlord.show.my-url value="{{ $user->facebook }}" label="Facebook" />
			<x-landlord.show.my-url value="{{ $user->linkedin }}" label="LinkedIn" />
		</div>
	</div>
	<!-- /.my-section-row -->

	<!-- Footer -->
	<div class="card-footer pt-0">
		<div class="d-flex justify-content-end gap-3">
			<a class="btn btn-secondary" href="{{ url()->previous() }}">Cancel</a>
			{{-- <a class="btn btn-primary" href="javascript:;">Save changes</a> --}}
			<button type="submit" id="submit" name="submit" class="btn btn-primary"><i class="bi bi-save"></i>
				Save</button>
		</div>
	</div>
	<!-- End Footer -->

	<div class="my-section-buttons">
		<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			<a class="btn btn-info" href="{{ route('users.edit', $user->id) }}">Edit</a>
		</div>
	</div>
@endsection
