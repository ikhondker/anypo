@extends('layouts.landlord.app')
@section('title','Edit Configuration')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('configs.index') }}" class="text-muted">Edit Configuration</a></li>
	<li class="breadcrumb-item active">{{ $config->name }}</li>
@endsection


@section('content')

	<h1 class="h3 mb-3">Edit Configuration</h1>
	<form id="myform" action="{{ route('configs.update', $config->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Edit Configuration</h5>
						<h6 class="card-subtitle text-muted">Edit Configuration Details.</h6>
					</div>
					<div class="card-body">

						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th width="30%">Logo</th>
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

							</tbody>
						</table>

					</div>
				</div>
			</div>
			<!-- end col-6 -->

			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<div class="card-actions float-end">
							{{-- <a href="{{ route('prs.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
							<a href="{{ route('prs.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a> --}}
						</div>
						<h5 class="card-title">Edit Requisition Additional Info</h5>
						<h6 class="card-subtitle text-muted">Edit Requisition Additional Info.</h6>
					</div>
					<div class="card-body">

						<table class="table table-sm my-2">
							<tbody>

								<x-landlord.edit.address1 value="{{ $config->address1 }}" />
									<x-landlord.edit.address2 value="{{ $config->address2 }}" />
									<x-landlord.edit.city-state-zip city="{{ $config->city }}" state="{{ $config->state }}" zip="{{ $config->zip }}"/>
									<x-landlord.edit.country :value="$config->country" />
									<x-landlord.edit.website url="{{ $config->website }}" />
									<x-landlord.edit.facebook url="{{ $config->facebook }}" />
									<x-landlord.edit.linkedin url="{{ $config->linkedin }}" />

							</tbody>
						</table>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Basic Information PR #</h5>
						<h6 class="card-subtitle text-muted">Edit Basic Information of Requisition.</h6>
					</div>
					<div class="card-body">

						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th>discount_pc_3 :</th>
									<td>
										<input type="number" class="form-control @error('discount_pc_3') is-invalid @enderror"
										name="discount_pc_3" id="discount_pc_3" placeholder="Name"
										value="{{ old('discount_pc_3', $config->discount_pc_3 ) }}"
										required/>
									@error('discount_pc_3')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>
								<tr>
									<th>discount_pc_6 :</th>
									<td>
										<input type="number" class="form-control @error('discount_pc_6') is-invalid @enderror"
										name="discount_pc_6" id="discount_pc_6" placeholder="Name"
										value="{{ old('discount_pc_6', $config->discount_pc_6 ) }}"
										required/>
									@error('discount_pc_6')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>

								<tr>
									<th>discount_pc_12 :</th>
									<td>
										<input type="number" class="form-control @error('discount_pc_12') is-invalid @enderror"
										name="discount_pc_12" id="discount_pc_12" placeholder="Name"
										value="{{ old('discount_pc_12', $config->discount_pc_12 ) }}"
										required/>
									@error('discount_pc_12')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>

								<tr>
									<th>discount_pc_24 :</th>
									<td>
										<input type="number" class="form-control @error('discount_pc_24') is-invalid @enderror"
										name="discount_pc_24" id="discount_pc_24" placeholder="Name"
										value="{{ old('discount_pc_24', $config->discount_pc_24 ) }}"
										required/>
									@error('discount_pc_24')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>

							</tbody>
						</table>



					</div>
				</div>
			</div>
			<!-- end col-6 -->

			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<div class="card-actions float-end">
							{{-- <a href="{{ route('prs.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
							<a href="{{ route('prs.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a> --}}
						</div>
						<h5 class="card-title">Edit Requisition Additional Info</h5>
						<h6 class="card-subtitle text-muted">Edit Requisition Additional Info.</h6>
					</div>
					<div class="card-body">

						<table class="table table-sm my-2">
							<tbody>

								<tr>
									<th>Days Gen Bill :</th>
									<td>
										<input type="number" class="form-control @error('days_gen_bill') is-invalid @enderror"
										name="days_gen_bill" id="days_gen_bill" placeholder="Name"
										value="{{ old('days_gen_bill', $config->days_gen_bill ) }}"
										required/>
									@error('days_gen_bill')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>
								<tr>
									<th>days_due :</th>
									<td>
										<input type="number" class="form-control @error('days_due') is-invalid @enderror"
										name="days_due" id="days_due" placeholder="Name"
										value="{{ old('days_due', $config->days_due ) }}"
										required/>
									@error('days_due')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>
								<tr>
									<th>days_past_due :</th>
									<td>
										<input type="number" class="form-control @error('days_past_due') is-invalid @enderror"
										name="days_past_due" id="days_past_due" placeholder="Name"
										value="{{ old('days_past_due', $config->days_past_due ) }}"
										required/>
									@error('days_past_due')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>
								<tr>
									<th>Days days_archive :</th>
									<td>
										<input type="number" class="form-control @error('days_archive') is-invalid @enderror"
										name="days_archive" id="days_archive" placeholder="Name"
										value="{{ old('days_archive', $config->days_archive ) }}"
										required/>
									@error('days_archive')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>
								<tr>
									<th>Days days_addon_free :</th>
									<td>
										<input type="number" class="form-control @error('days_addon_free') is-invalid @enderror"
										name="days_addon_free" id="days_addon_free" placeholder="Name"
										value="{{ old('days_addon_free', $config->days_addon_free ) }}"
										required/>
									@error('days_addon_free')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>
							</tbody>
						</table>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Future Information</h5>
						<h6 class="card-subtitle text-muted">Edit Basic Information of Requisition.</h6>
					</div>
					<div class="card-body">

						<table class="table table-sm my-2">
							<tbody>

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

					</div>
				</div>
			</div>
			<!-- end col-6 -->

			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<div class="card-actions float-end">
							{{-- <a href="{{ route('prs.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
							<a href="{{ route('prs.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a> --}}
						</div>
						<h5 class="card-title">Future Information</h5>
						<h6 class="card-subtitle text-muted">Edit Requisition Additional Info.</h6>
					</div>
					<div class="card-body">

						<table class="table table-sm my-2">
							<tbody>



							</tbody>
						</table>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>
		<x-landlord.edit.save/>
	</form>


	<div class="card">

		<div class="card-body">


				<table class="table table-sm my-2">
					<tbody>










					</tbody>
				</table>


			</form>
		</div>
	</div>

@endsection

