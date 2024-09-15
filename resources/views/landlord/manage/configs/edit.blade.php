@extends('layouts.landlord.app')
@section('title','Edit config')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('configs.index') }}" class="text-muted">Configs</a></li>
	<li class="breadcrumb-item active">{{ $config->name }}</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">EditConfig</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Billing Config</h5>
			<h6 class="card-subtitle text-muted">EditConfig Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('configs.update', $config->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th width="30%">Photo</th>
							<td>
								<div class="">
									<img src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" class="rounded-circle img-responsive mt-2" width="128" height="128" alt="{{ $config->name }}" title="{{ $config->name }}"/>
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

						<x-landlord.edit.id-read-only :value="$config->id" />
						<x-landlord.edit.name value="{{ $config->name }}" />
						<x-landlord.edit.tagline value="{{ $config->tagline }}" />

						<x-landlord.edit.email value="{{ $config->email }}" />
						<x-landlord.edit.cell value="{{ $config->cell }}" />
						<x-landlord.edit.address1 value="{{ $config->address1 }}" />
						<x-landlord.edit.address2 value="{{ $config->address2 }}" />

						<x-landlord.edit.city-state-zip city="{{ $config->city }}" state="{{ $config->state }}" zip="{{ $config->zip }}"/>

						<x-landlord.edit.country :value="$config->country" />

						<x-landlord.edit.website url="{{ $config->website }}" />
						<x-landlord.edit.facebook url="{{ $config->facebook }}" />
						<x-landlord.edit.linkedin url="{{ $config->linkedin }}" />


							<tr>
								<th>Maintenance :</th>
								<td>
									<label class="form-check form-switch" for="admin">
										<input class="form-check-input mt-0" type="checkbox" id="maintenance" name="maintenance" @checked($config->maintenance)>
										<span class="d-block"> Enable Maintenance?</span>
										<span class="d-block small text-danger">Caution! Will show Maintenance Banner for ALL tenants. Now: {{ date('d-M-Y H:i:s', strtotime(now())) }}</span>
										<span class="d-block small text-muted"> </span>
									</label>
									@error('maintenance')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>


							<tr>
								<th>Maintenance Schedule:</th>
								<td>
									<div class="row">
										<div class="col-md-4">
											<input type="datetime-local" class="form-control @error('maintenance_start_time') is-invalid @enderror"
											name="maintenance_start_time" id="maintenance_start_time" placeholder="maintenance_start_time"
											value="{{ old('maintenance_start_time', date('d-m-Y h:m:s',strtotime($config->maintenance_start_time)) ) }}"
											/>
											@error('maintenance_start_time')
												<div class="small text-danger">{{ $message }}</div>
											@enderror

										</div>
										<div class="col-md-4">
											<input type="datetime-local" class="form-control @error('maintenance_end_time') is-invalid @enderror"
												name="maintenance_end_time" id="maintenance_end_time" placeholder="maintenance_end_time"
												value="{{ old('maintenance_end_time', date('Y-m-d',strtotime($config->maintenance_end_time)) ) }}"
												/>
												@error('maintenance_end_time')
													<div class="small text-danger">{{ $message }}</div>
												@enderror
										</div>
									</div>
								</td>
							</tr>



							<tr>
								<th>Banner :</th>
								<td>
									<label class="form-check form-switch" for="admin">
										<input class="form-check-input mt-0" type="checkbox" id="banner" name="banner" @checked($config->banner)>
										<span class="d-block"> Display Banner in ALL Tenant?</span>
										<span class="d-block small text-danger">Be careful! This will display Banner for ALL tenants.</span>
									</label>
									@error('banner')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>



							<tr>
								<th>Banner Message :</th>
								<td>
									<textarea class="form-control" rows="3" name="banner_message" placeholder="Enter ...">{{ old('content', $config->banner_message) }}</textarea>
										@error('banner_message')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
								</td>
							</tr>



					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection

