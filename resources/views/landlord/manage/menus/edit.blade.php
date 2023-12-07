@extends('layouts.landlord-app')
@section('title','Edit Menu')
@section('breadcrumb','Edit Menu')

@section('content')
	<!-- Card -->
	<div class="card">

		<form id="myform" action="{{ route('menus.update',$menu->id) }}" method="POST">
			@csrf
			@method('PUT')

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Edit Menu</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">
			
				<!-- Form -->
				<div class="row mb-4">
					<label class="col-sm-3 col-form-label form-label">Profile photo</label>

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

						<button type="button" class="js-file-attach-reset-img btn btn-white btn-sm">Delete</button>
						</div>
					</div>
					<!-- End Media -->
					</div>
				</div>
				<!-- End Form -->

				<x-landlord.edit.id-read-only :value="$menu->id"/>

				<!-- Form -->
				<div class="row mb-4">
					<label for="raw_route_name" class="col-sm-3 col-form-label form-label">Raw Route Name :</label>
					<div class="col-sm-9">
					<input type="text" class="form-control @error('raw_route_name') is-invalid @enderror" 
							name="raw_route_name" id="raw_route_name" placeholder="raw_route_name"     
							value="{{ old('raw_route_name', $menu->raw_route_name ) }}"
							required/>
						@error('raw_route_name')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<!-- End Form -->

				<!-- Form -->
				<div class="row mb-4">
					<label for="route_name" class="col-sm-3 col-form-label form-label">Route Name :</label>
					<div class="col-sm-9">
					<input type="text" class="form-control @error('route_name') is-invalid @enderror" 
							name="route_name" id="route_name" placeholder="route_name"     
							value="{{ old('route_name', $menu->route_name ) }}"
							required/>
						@error('route_name')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<!-- End Form -->

				<!-- Form -->
				<div class="row mb-4">
					<label for="access" class="col-sm-3 col-form-label form-label">Access :</label>
					<div class="col-sm-9">
					<input type="text" class="form-control @error('access') is-invalid @enderror" 
							style="text-transform: uppercase"
							name="access" id="access" placeholder="F"     
							value="{{ old('access', $menu->access ) }}"
							required/>
						@error('access')
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
