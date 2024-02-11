@extends('layouts.app')
@section('title','Edit Setup')
@section('breadcrumb','Edit Setup')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Setup
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Setup"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('setups.update',$setup->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Basic Info</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label">Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Full Name"
									value="{{ old('name', $setup->name ) }}"
									required/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Tagline</label>
								<input type="text" class="form-control @error('tagline') is-invalid @enderror"
									name="tagline" id="tagline" placeholder="Tagline"
									value="{{ old('tagline', $setup->tagline ) }}"
									required/>
								@error('tagline')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Primary Admin</label>
								<select class="form-control" name="admin_id">
									@foreach ($admins as $user)
										<option {{ $user->id == old('admin_id',$setup->admin_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
									@endforeach
								</select>
							</div>

						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Financial</h5>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">Currency</label>
								<input type="text" name="currency" id="currency" class="form-control" placeholder="USD" value="{{ old('currency', $setup->currency ) }}" readonly>
							</div>


							<div class="mb-3">
								<label class="form-label">Tax %</label>
								<input type="text" class="form-control @error('tax') is-invalid @enderror"
									name="tax" id="tax" placeholder="0.00"
									value="{{ old('tax', $setup->tax ) }}"
									/>
								@error('currency')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">GST %</label>
								<input type="text" class="form-control @error('gst') is-invalid @enderror"
									name="gst" id="gst" placeholder="0.00"
									value="{{ old('gst', $setup->gst ) }}"
									/>
								@error('gst')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Web Presence</h5>
						</div>
						<div class="card-body">
							 <div class="mb-3">
								<label class="form-label">Email</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror"
									name="email" id="email" placeholder="name@company.com"
									value="{{ old('email', $setup->email ) }}"
									required/>
								@error('email')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">Website</label>
								<input type="text" class="form-control @error('website') is-invalid @enderror"
									name="website" id="website" placeholder="https://www.example.com"
									value="{{ old('website', $setup->website ) }}"
									required/>
								@error('website')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">Facebook</label>
								<input type="text" class="form-control @error('facebook') is-invalid @enderror"
									name="facebook" id="facebook" placeholder="https://www.facebook.com/username"
									value="{{ old('facebook', $setup->facebook ) }}"
									required/>
								@error('facebook')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">LinkedIn</label>
								<input type="text" class="form-control @error('linkedin') is-invalid @enderror"
									name="linkedin" id="linkedin" placeholder="https://www.linkedin.com/username"
									value="{{ old('linkedin', $setup->linkedin ) }}"
									required/>
								@error('linkedin')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Address</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label">Address 1</label>
								<input type="text" class="form-control @error('address1') is-invalid @enderror"
									name="address1" id="address1" placeholder="Address 1"
									value="{{ old('address1', $setup->address1 ) }}"
									required/>
								@error('address1')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Address 2</label>
								<input type="text" class="form-control @error('address2') is-invalid @enderror"
									name="address2" id="address2" placeholder="Address 2"
									value="{{ old('address2', $setup->address2 ) }}"
									required/>
								@error('address2')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="row">
								<div class="mb-3 col-md-6">
									<label for="city" class="form-label">City</label>
									<input type="text" class="form-control @error('city') is-invalid @enderror"
										name="city" id="city" placeholder="City"
										value="{{ old('city', $setup->city ) }}"
										required/>
									@error('city')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3 col-md-4">
									<label for="state" class="form-label">State</label>
									<input type="text" class="form-control @error('state') is-invalid @enderror"
										name="state" id="state" placeholder="N/A"
										value="{{ old('state', $setup->state ) }}"
										required/>
									@error('state')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3 col-md-2">
									<label for="zip" class="form-label">Zip</label>
									<input type="text" class="form-control @error('zip') is-invalid @enderror"
										name="zip" id="zip" placeholder="1234"
										value="{{ old('zip', $setup->zip ) }}"
										required/>
									@error('zip')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>

								<div class="mb-3">
									<label class="form-label">Country</label>
									<select class="form-control" name="country">
										@foreach ($countries as $country)
											<option {{ $country->country == old('country',$setup->country) ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->name }} </option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
						<h5 class="card-title">Logo (90x90)</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<img src="{{ Storage::disk('s3tl')->url($setup->logo) }}" alt="{{ $setup->name }}" class="rounded-circle rounded me-2 mb-2" title="{{ $setup->name }}" width="120px">
								{{-- <x-tenant.show.logo logo="{{ $setup->logo }}"/> --}}
								<x-tenant.attachment.create  />
							</div>
						</div>
					</div>
				</div>
				<!-- end col-6 -->
				<div class="col-6">
					<div class="card">
						<div class="card-header">
						<h5 class="card-title">Contact</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label">Cell</label>
								<input type="text" class="form-control @error('cell') is-invalid @enderror"
									name="cell" id="cell" placeholder="01911310509"
									value="{{ old('cell', $setup->cell ) }}"
									required/>
								@error('cell')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.buttons.show.save/>
						</div>
					</div>
				</div>
				<!-- end col-6 -->


			</div>
			<!-- end row -->
	</form>
	<!-- /.form end -->
@endsection

