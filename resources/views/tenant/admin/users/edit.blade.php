@extends('layouts.app')
@section('title','Edit User')
@section('breadcrumb','Edit User')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit User
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="User"/>
			<x-tenant.buttons.header.create object="User"/>
			<x-tenant.buttons.header.password :id="$user->id"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">User Info</h5>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">ID</label>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $user->id ) }}" readonly>
							</div>

							<div class="mb-3">
								<label class="form-label">Full Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" 
									name="name" id="name" placeholder="Full Name"     
									value="{{ old('name', $user->name ) }}"
									required/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

						  

							<div class="mb-3">
								<label class="form-label">Email</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" 
									name="email" id="email" placeholder="name@company.com"     
									value="{{ old('email', $user->email ) }}"
									readonly/>
								@error('email')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Designation</label>
								<select class="form-control" name="designation_id">
									@foreach ($designations as $designation)
										<option {{ $designation->id == old('designation_id',$user->designation_id) ? 'selected' : '' }} value="{{ $designation->id }}">{{ $designation->name }} </option>
									@endforeach
								</select>
							</div>

							<div class="mb-3">
								<label class="form-label">Cell</label>
								<input type="text" class="form-control @error('cell') is-invalid @enderror" 
									name="cell" id="cell" placeholder="01911310509"     
									value="{{ old('cell', $user->cell ) }}"
									required/>
								@error('cell')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							@if ( ( \App\Helpers\CheckAccess::aboveAdmin(auth()->user()->role->value) ) && (auth()->user()->id <> $user->id) )
								<div class="mb-3">
									<label class="form-label text-danger">Modify Role:</label>
									<select class="form-control" name="role">
										<option {{ 'user' == old('role',$user->role->value) ? 'selected' : '' }}  value="user">User</option>
										<option {{ 'buyer' == old('role',$user->role->value) ? 'selected' : '' }} value="buyer">Buyer</option>
										<option {{ 'hod' == old('role',$user->role->value) ? 'selected' : '' }} value="hod">HoD</option>
										<option {{ 'cxo' == old('role',$user->role->value) ? 'selected' : '' }} value="cxo">CxO</option>
										<option {{ 'admin' == old('role',$user->role->value) ? 'selected' : '' }} value="admin">Admin</option>
									</select>
								</div>
							@endif
						</div>
					</div>
				</div>
				<!-- end col-6 -->

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
									value="{{ old('address1', $user->address1 ) }}"
									required/>
								@error('address1')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Address 2</label>
								<input type="text" class="form-control @error('address2') is-invalid @enderror" 
									name="address2" id="address2" placeholder="Address 2"     
									value="{{ old('address2', $user->address2 ) }}"
									/>
								@error('address2')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="row">
								<div class="mb-3 col-md-6">
									<label for="city" class="form-label">City</label>
									<input type="text" class="form-control @error('city') is-invalid @enderror" 
										name="city" id="city" placeholder="City"     
										value="{{ old('city', $user->city ) }}"
										required/>
									@error('city')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3 col-md-4">
									<label for="state" class="form-label">State</label>
									<input type="text" class="form-control @error('state') is-invalid @enderror" 
										name="state" id="state" placeholder="N/A"     
										style="text-transform: uppercase"
										value="{{ old('state', $user->state ) }}"
										required/>
									@error('state')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3 col-md-2">
									<label for="zip" class="form-label">Zip</label>
									<input type="text" class="form-control @error('zip') is-invalid @enderror" 
										name="zip" id="zip" placeholder="1234"     
										value="{{ old('zip', $user->zip ) }}"
										required/>
									@error('zip')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label">Country</label>
								<select class="form-control" name="country">
									@foreach ($countries as $country)
										<option {{ $country->country == old('country',$user->country) ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->name }} </option>
									@endforeach
								</select>
							</div>


						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Avatar</h5>
						</div>
						<div class="card-body">
							<div class="mb-3">
								{{-- <x-tenant.show.avatar avatar="{{ $user->avatar }}"/> --}}
								<img src="{{ Storage::disk('s3ta')->url($user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle rounded me-2 mb-2" title="{{ $user->name }}" width="120px">
								
								<x-tenant.attachment.create  />
							</div>
						</div>
					</div>
				</div>
				<!-- end col-6 -->
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Social</h5>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">Facebook</label>
								<input type="text" class="form-control @error('facebook') is-invalid @enderror" 
									name="facebook" id="facebook" placeholder="https://www.facebook.com/username" 
									value="{{ old('facebook', $user->facebook ) }}"      
									/>
								@error('facebook')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">LinkedIn</label>
								<input type="text" class="form-control @error('linkedin') is-invalid @enderror" 
									name="linkedin" id="linkedin" placeholder="https://www.linkedin.com/username" 
									value="{{ old('linkedin', $user->linkedin ) }}"      
									/>
								@error('linkedin')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.widgets.submit/>
						</div>
					</div>
				</div>
				<!-- end col-6 -->

			</div>
			<!-- end row -->

	</form>
	<!-- /.form end -->
@endsection

