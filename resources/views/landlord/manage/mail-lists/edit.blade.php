@extends('layouts.landlord.app')
@section('title','Edit Category')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('mail-lists.index') }}" class="text-muted">Tickets</a></li>
	<li class="breadcrumb-item active">{{ $ticket->name }}</li>
@endsection


@section('content')
	<!-- Card -->
	<div class="card">

		<form id="myform" action="{{ route('mail-lists.update',$category->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Edit Category</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">


				<!-- Form -->
				<div class="row mb-4">
					<label class="col-sm-3 col-form-label form-label">Category photo</label>

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

				<x-landlord.edit.id-read-only :value="$category->id"/>
				<x-landlord.edit.name :value="$category->name"/>


			</div>
			<!-- End Body -->

			<x-landlord.edit.save/>
		</form>
	</div>
	<!-- End Card -->
@endsection
