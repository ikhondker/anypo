@extends('layouts.landlord.app')
@section('title','Edit Account')
@section('breadcrumb','Edit Account')

@section('content')

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Billing Account</h5>
			<h6 class="card-subtitle text-muted">Edit Billing Account Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('accounts.update', $account->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th width="30%">Photo</th>
							<td>
								<div class="">
									<img src="{{ Storage::disk('s3l')->url('logo/'.$account->logo) }}" class="rounded-circle img-responsive mt-2" width="128" height="128" alt="{{ $account->name }}" title="{{ $account->name }}"/>
									<div class="mt-2">
										<input type="file" id="file_to_upload" name="file_to_upload"
										accept=".jpg,.jpeg,.png,.gif"
										placeholder="file_to_upload"
										onchange="mySubmit()" style="display:none;" />
										<a href="" class="btn btn-primary mt-n1" onclick="document.getElementById('file_to_upload').click(); return false">
											<i class="fas fa-upload"></i> Upload</a>
									</div>
									<small>For best results, use an image at least 128px by 128px in .jpg format</small>
								</div>
							</td>
						</tr>

                        <tr>
                            <th>Site X:</th>
                            <td>
                                <input type="text" name="id" id="id" class="form-control" placeholder="ID"
                                value="{{ $account->site }}" readonly>
                            </td>
                        </tr>

          				<x-landlord.edit.name :value="$account->name" />
                        <x-landlord.edit.tagline value="{{ $account->tagline }}"/>
                        <x-landlord.edit.email :value="$account->email" />
                        <x-landlord.edit.cell value="{{ $account->cell }}" />
                        <x-landlord.edit.address1 value="{{ $account->address1 }}" />
                        <x-landlord.edit.address2 value="{{ $account->address2 }}" />
                        <x-landlord.edit.city-state-zip city="{{ $account->city }}" state="{{ $account->state }}" zip="{{ $account->zip }}"/>
                        <x-landlord.edit.country :value="$account->country" />
                        <x-landlord.edit.website url="{{ $account->website }}" />
                        <x-landlord.edit.facebook url="{{ $account->facebook }}" />
                        <x-landlord.edit.linkedin url="{{ $account->linkedin }}" />

					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>


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
							<img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3l')->url('logo/'.$account->logo) }}" alt="{{ $account->name }}" title="{{ $account->name }}">
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

			{{-- <x-landlord.edit.id-read-only :value="$account->id" /> --}}


			<x-landlord.edit.name :value="$account->name" />
			<x-landlord.edit.tagline value="{{ $account->tagline }}"/>
			<x-landlord.edit.email :value="$account->email" />
			<x-landlord.edit.cell value="{{ $account->cell }}" />
			<x-landlord.edit.address1 value="{{ $account->address1 }}" />
			<x-landlord.edit.address2 value="{{ $account->address2 }}" />
			<x-landlord.edit.city-state-zip city="{{ $account->city }}" state="{{ $account->state }}" zip="{{ $account->zip }}"/>
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
