@extends('layouts.landlord-app')
@section('title','Edit User Profile')
@section('breadcrumb','Edit User Profile')

@section('content')
	<!-- Card -->
	<div class="card">

		<form id="myform" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<input type="hidden" name="id" value="{{ $user->id }}">

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Edit User</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-floppy"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">

				<!-- Form -->
				<div class="row mb-4">
					<label class="col-sm-3 col-form-label form-label">Profile Photo</label>

					<div class="col-sm-9">
					<!-- Media -->

						<div class="d-flex align-items-center">
							<!-- Avatar -->
							<label class="avatar avatar-xl avatar-circle" for="avatarUploader">
								<img id="avatarImg" class="avatar-img" src="{{  Storage::disk('s3la')->url($user->avatar) }}" alt="{{ $user->name }}" title="{{ $user->name }}">
							</label>
							<div class="d-grid d-sm-flex gap-2 ms-4">
								<input type="file" class="form-control form-control-sm" name="file_to_upload"
									id="file_to_upload"
									accept=".jpg,.jpeg,.png,.gif"
									placeholder="file_to_upload"> 
							</div>
							<!-- End Avatar -->
						</div>
						@error('file_to_upload')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror

					<!-- End Media -->
					</div>
				</div>
				<!-- End Form -->

				<x-landlord.edit.name :value="$user->name"/>
			 	<!-- Form -->
				<div class="row mb-4">
					<label for="email" class="col-sm-3 col-form-label form-label">Email :</label>
					<div class="col-sm-9">
						<input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" value="{{ $user->email }}" readonly>
					</div>
				</div>
				<!-- End Form -->
				<x-landlord.edit.cell value="{{ $user->cell }}"/>
				<x-landlord.edit.address1 value="{{ $user->address1 }}"/>
				<x-landlord.edit.address2 value="{{ $user->address2 }}"/>
				<!-- Form -->
				<div class="row mb-4">
					<label class="col-sm-3 col-form-label form-label"></label>
					<div class="col-sm-9">
						<div class="row">
							<x-landlord.edit.city value="{{ $user->city }}"/>
							<x-landlord.edit.state value="{{ $user->state }}"/>
							<x-landlord.edit.zip value="{{ $user->zip }}"/>
						</div>
					</div>
				</div>
				<!-- End Form -->
				<x-landlord.edit.country :value="$user->country"/>

			</div>
			<!-- End Body -->

			<x-landlord.edit.save/>
		</form>
	</div>
	<!-- End Card -->
@endsection
