@extends('layouts.landlord.app')
@section('title','Edit Service')
@section('breadcrumb','Edit Service')

@section('content')
	<!-- Card -->
	<div class="card">

		<form id="myform" action="{{ route('services.update',$service->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Edit Service</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">


				<!-- Form -->
				<div class="row mb-4">
					<label class="col-sm-3 col-form-label form-label">Service photo</label>

					<div class="col-sm-9">
					<!-- Media -->
					<div class="d-flex align-items-center">
						<!-- Avatar -->
						<label class="avatar avatar-xl avatar-circle" for="avatarUploader">
						<img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Image Description">
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

						<button type="button" class="js-file-attach-reset-img btn btn-white btn-sm">Delete</button>
						</div>
					</div>
					<!-- End Media -->
					</div>
				</div>
				<!-- End Form -->

				<x-landlord.edit.id-read-only :value="$service->id"/>
				<x-landlord.edit.name :value="$service->name"/>
			 	<!-- Form -->
				<div class="row mb-4">
					<label for="emailLabel" class="col-sm-3 col-form-label form-label">mnth:</label>
					<div class="col-sm-9">
						<input type="number" class="form-control @error('mnth') is-invalid @enderror"
							name="mnth" id="mnth" placeholder="Name"
							value="{{ old('mnth', $service->mnth ) }}"
							required/>
						@error('mnth')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror

					</div>
				</div>
				<!-- End Form -->
				<!-- Form -->
				<div class="row mb-4">
					<label for="emailLabel" class="col-sm-3 col-form-label form-label">user:</label>
					<div class="col-sm-9">
						<input type="number" class="form-control @error('mnth') is-invalid @enderror"
							name="user" id="user" placeholder="Name"
							value="{{ old('user', $service->user ) }}"
							required/>
						@error('user')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror

					</div>
				</div>
				<!-- End Form -->

				<!-- Form -->
				<div class="row mb-4">
					<label for="gb" class="col-sm-3 col-form-label form-label">gb:</label>
					<div class="col-sm-9">
						<input type="number" class="form-control @error('gb') is-invalid @enderror"
							name="gb" id="gb" placeholder="Name"
							value="{{ old('gb', $service->gb ) }}"
							required/>
						@error('gb')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror

					</div>
				</div>
				<!-- End Form -->

				<!-- Form -->
				<div class="row mb-4">
					<label for="price" class="col-sm-3 col-form-label form-label">price:</label>
					<div class="col-sm-9">
						<input type="text" class="form-control @error('price') is-invalid @enderror"
							name="price" id="price" placeholder="Name"
							value="{{ old('price', $service->price ) }}"
							required/>
						@error('price')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror

					</div>
				</div>
				<!-- End Form -->


				<!-- Form -->
				<div class="row mb-4">
					<label for="start_date" class="col-sm-3 col-form-label form-label">start_date:</label>
					<div class="col-sm-9">
						<input type="date" class="form-control @error('price') is-invalid @enderror"
							name="start_date" id="start_date" placeholder="Name"
							value="{{ old('start_date', $service->start_date ) }}"
							required/>
						@error('start_date')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror

					</div>
				</div>
				<!-- End Form -->
				<!-- Form -->
				<div class="row mb-4">
					<label for="end_date" class="col-sm-3 col-form-label form-label">end_date:</label>
					<div class="col-sm-9">
						<input type="date" class="form-control @error('price') is-invalid @enderror"
							name="end_date" id="end_date" placeholder="Name"
							value="{{ old('end_date', $service->end_date ) }}"
							required/>
						@error('end_date')
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
