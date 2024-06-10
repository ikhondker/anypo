@extends('layouts.landlord.app')
@section('title','Entity')
@section('breadcrumb','View Entity')

@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Entity info</h4>
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
					</div>
					</div>
					<!-- End Media -->
				</div>
				</div>
				<!-- End Form -->

				<x-landlord.show.my-badge	value="{{ $entity->entity }}" label="Code"/>
				<x-landlord.show.my-text	value="{{ $entity->name }}" label="Name"/>
				<x-landlord.show.my-text	value="{{ $entity->model }}" label="Model"/>
				<x-landlord.show.my-text	value="{{ $entity->route }}" label="Route"/>
				<x-landlord.show.my-badge	value="{{ $entity->directory }}" label="Directory"/>
				<x-landlord.show.my-text	value="{{ $entity->parent_entity }}" label="Parent"/>
				<x-landlord.show.my-enable	value="{{ $entity->enable }}"/>
				<x-landlord.show.my-enable	value="{{ $entity->notification }}" label="Notification"/>

		</div>
		<!-- End Body -->

		<!-- Footer -->
		<div class="card-footer pt-0">
			<div class="d-flex justify-content-end gap-3">
				<a class="btn btn-primary" href="{{ route('entities.edit',$entity->entity) }}">Edit</a>
			</div>
		</div>
		<!-- End Footer -->
	</div>
	<!-- End Card -->

@endsection
