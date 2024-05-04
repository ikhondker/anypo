@extends('layouts.landlord-app')
@section('title','Change Password')
@section('breadcrumb','Change Password')

@section('content')

<!-- Card -->
<div class="card">
	<form action="{{ route('users.password-update',['user'=>$user->id]) }}" method="POST">
		@csrf
		{{-- @method('PUT') --}}
		<input type="hidden" name="id" value="{{ $user->id }}">

		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Change Password</h5>
			<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-floppy"></i> Save</button>
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
							<img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3l')->url('avatar/'.$user->avatar) }}"
								alt="{{ $user->name }}" title="{{ $user->name }}">
						</label>
						<div class="d-grid d-sm-flex gap-2 ms-4">

						</div>
						<!-- End Avatar -->
					</div>
					<!-- End Media -->

				</div>
			</div>
			<!-- End Form -->

			<!-- Form -->
			<div class="row mb-4">
				<label for="name" class="col-sm-3 col-form-label form-label">Name:</label>
				<div class="col-sm-9">
					<input type="text" name="name" id="name" class="form-control" placeholder="name" value="{{ $user->name }}" readonly>
				</div>
			</div>
			<!-- End Form -->
			<!-- Form -->
			<div class="row mb-4">
				<label for="email" class="col-sm-3 col-form-label form-label">Email :</label>
				<div class="col-sm-9">
					<input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" value="{{ $user->email }}" readonly>
				</div>
			</div>
			<!-- End Form -->


			<!-- Form -->
			<div class="row mb-4">
				<label for="password1" class="col-sm-3 col-form-label form-label">Password:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control form-control-sm @error('password1') is-invalid @enderror"
							name="password1" id="password1" placeholder="New Password"
							value="{{ old('password1', $user->password1 ) }}"
							required/>
						@error('password1')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
				</div>
			</div>
			<!-- End Form -->

			 <!-- Form -->
			 <div class="row mb-4">
				<label for="password2" class="col-sm-3 col-form-label form-label">Confirm Password:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control form-control-sm @error('password2') is-invalid @enderror"
							name="password2" id="password2" placeholder="Re-enter Password"
							value="{{ old('password2', $user->password2 ) }}"
							required/>
						@error('password2')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
				</div>
			</div>
			<!-- End Form -->

		</div>
		<!-- End Body -->

		<x-landlord.edit.save/>
	</form>
</div>
<!-- End Card -->


@endsection


