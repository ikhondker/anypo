@extends('layouts.landlord-app')
@section('title','Edit Account')
@section('breadcrumb','Edit Account')

@section('content')

<!-- Card -->
<div class="card">
	<form id="myform" action="{{ route('accounts.update',$account->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Edit Billing Account</h5>
			<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-floppy"></i> Save</button>
		</div>

		<!-- Body -->
		<div class="card-body">
			<!-- Form -->
			<div class="row mb-4">
				<label class="col-sm-3 col-form-label form-label">Account Logo</label>

				<div class="col-sm-9">
					<!-- Media -->
					<div class="d-flex align-items-center">
						<!-- Avatar -->
						<label class="avatar avatar-xl avatar-circle" for="avatarUploader">
							<img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3ll')->url($account->logo) }}" alt="{{ $account->name }}" title="{{ $account->name }}">
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

			<x-landlord.edit.id-read-only :value="$account->id" />

			<!-- Form -->
			<div class="row mb-4">
				<label for="id" class="col-sm-3 col-form-label form-label">Site:</label>
				<div class="col-sm-9">
					<input type="text" name="id" id="id" class="form-control" placeholder="ID"
						value="{{ $account->site }}" readonly>
				</div>
			</div>
			<!-- End Form -->

			<x-landlord.edit.name :value="$account->name" />
			<x-landlord.edit.tagline value="{{ $account->tagline }}"/>



			<x-landlord.edit.email :value="$account->email" />
			<x-landlord.edit.cell value="{{ $account->cell }}" />
			<x-landlord.edit.address1 value="{{ $account->address1 }}" />
			<x-landlord.edit.address2 value="{{ $account->address2 }}" />
			<!-- Form -->
			<div class="row mb-4">
				<label class="col-sm-3 col-form-label form-label"></label>
				<div class="col-sm-9">
					<div class="row">
						<x-landlord.edit.city value="{{ $account->city }}" />
						<x-landlord.edit.state value="{{ $account->state }}" />
						<x-landlord.edit.zip value="{{ $account->zip }}" />
					</div>
				</div>
			</div>
			<!-- End Form -->
			<x-landlord.edit.country :value="$account->country" />

			<x-landlord.edit.website url="{{ $account->website }}" />
			<x-landlord.edit.facebook url="{{ $account->facebook }}" />
			<x-landlord.edit.linkedin url="{{ $account->linkedin }}" />


		</div>
		<!-- End Body -->

		<x-landlord.edit.save />
	</form>
</div>
<!-- End Card -->


@endsection