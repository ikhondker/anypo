@extends('layouts.landlord-app')
@section('title','Edit Setup')
@section('breadcrumb','Edit Setup')

@section('content')

<!-- Card -->
<div class="card">
	<form action="{{ route('setups.update',$setup->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Setup Edit</h5>
			<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
		</div>

		<!-- Body -->
		<div class="card-body">
			<!-- Form -->
			<div class="row mb-4">
				<label class="col-sm-3 col-form-label form-label">Setup Logo</label>

				<div class="col-sm-9">
					<!-- Media -->
					<div class="d-flex align-items-center">
						<!-- Avatar -->
						<label class="avatar avatar-xl avatar-circle" for="avatarUploader">
							<img id="avatarImg" class="avatar-img" src="{{ asset('/assets/img/160x160/img9.jpg') }}"
								alt="Image Description">
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

			<x-landlord.edit.id-read-only :value="$setup->id" />
			<x-landlord.edit.name :value="$setup->name" />
			<x-landlord.edit.tagline :value="$setup->tagline" />
			

			<x-landlord.edit.email :value="$setup->email" />
			<x-landlord.edit.cell value="{{ $setup->cell }}" />
			<x-landlord.edit.address1 value="{{ $setup->address1 }}" />
			<x-landlord.edit.address2 value="{{ $setup->address2 }}" />
			<!-- Form -->
			<div class="row mb-4">
				<label class="col-sm-3 col-form-label form-label"></label>
				<div class="col-sm-9">
					<div class="row">
						<x-landlord.edit.city value="{{ $setup->city }}" />
						<x-landlord.edit.state value="{{ $setup->state }}" />
						<x-landlord.edit.zip value="{{ $setup->zip }}" />
					</div>
				</div>
			</div>
			<!-- End Form -->
			<x-landlord.edit.country :value="$setup->country" />

			<x-landlord.edit.website url="{{ $setup->website }}" />
			<x-landlord.edit.facebook url="{{ $setup->facebook }}" />
			<x-landlord.edit.linkedin url="{{ $setup->linkedin }}" />

			<div class="row mb-4">
				<label for="logo" class="col-sm-3 col-form-label form-label">Image:</label>
				<div class="col-sm-9">
					<x-landlord.attachment.create />
				</div>
			</div>

			<div class="row mb-4">
				<label for="maintenance" class="col-sm-3 col-form-label form-label">Maintenance:</label>
				<div class="col-sm-9">
						<label class="form-check form-switch" for="admin">
							<input class="form-check-input mt-0" type="checkbox" id="maintenance" name="maintenance" @checked($setup->maintenance)>
							<span class="d-block"> Enable Maintenance</span>
							<span class="d-block small text-muted">Be careful! This will Enable Maintenance</span>
						</label>
						@error('maintenance')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
				</div>
			</div>

			<div class="row mb-4">
				<label for="show_banner" class="col-sm-3 col-form-label form-label">Display Banner:</label>
				<div class="col-sm-9">
						<label class="form-check form-switch" for="admin">
							<input class="form-check-input mt-0" type="checkbox" id="show_banner" name="show_banner" @checked($setup->show_banner)>
							<span class="d-block"> Display Banner?</span>
							<span class="d-block small text-muted">Be careful! This will Display Banner</span>
						</label>
						@error('show_banner')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
				</div>
			</div>

			<!-- Form -->
			<div class="row mb-4">
				<label for="banner_message" class="col-sm-3 col-form-label form-label">Banner Message X:</label>
				<div class="col-sm-9">
					<textarea class="form-control" rows="3" name="banner_message" placeholder="Enter ...">{{ old('content', $setup->banner_message) }}</textarea>
						@error('banner_message')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
				</div>
			</div>
			<!-- End Form -->

		</div>
		<!-- End Body -->

		<x-landlord.edit.save />
	</form>
</div>
<!-- End Card -->

@endsection

