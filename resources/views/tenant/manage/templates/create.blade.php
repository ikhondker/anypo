@extends('layouts.app')
@section('title','Template')
@section('breadcrumb','Create Templates v1.3 (8-MAY-23)')


@section('content')
<x-tenant.page-header>
	@slot('title')
		Create Template
	@endslot
	@slot('buttons')
		<button class="btn btn-primary me-1" type="submit" form="myform"><i class="fas fa-save"></i> Save</button>
		<a href="{{ route('templates.index') }}" class="btn btn-primary float-end me-2"><i class="fas fa-list"></i> Template List</a>
	@endslot
</x-tenant.page-header>

<!-- form start -->
<form id="myform" action="{{ route('templates.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Template Info</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
				</div>
				<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Full Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror"
								name="name" id="name" placeholder="Full Name"
								value="{{ old('name', '' ) }}"
								required/>
							@error('name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">Summary</label>
							<input type="text" class="form-control @error('summary') is-invalid @enderror"
								name="summary" id="summary" placeholder="Summary"
								value="{{ old('summary', '' ) }}"
								required/>
							@error('summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">Email</label>
							<input type="email" class="form-control @error('email') is-invalid @enderror"
								name="email" id="email" placeholder="name@company.com"
								value="{{ old('email', 'email@example.com' ) }}"
								required/>
							@error('email')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Cell</label>
							<input type="text" class="form-control @error('cell') is-invalid @enderror"
								name="cell" id="cell" placeholder="01911310509"
								value="{{ old('cell', '01911310509' ) }}"
								required/>
							@error('cell')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<x-tenant.buttons.show.save/>


				</div>
			</div>
		</div>
		<!-- end col -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Address</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
				</div>
				<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Address 1</label>
							<input type="text" class="form-control @error('address1') is-invalid @enderror"
								name="address1" id="address1" placeholder="Address 1"
								value="{{ old('address1', '' ) }}"
								required/>
							@error('address1')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Address 2</label>
							<input type="text" class="form-control @error('address2') is-invalid @enderror"
								name="address2" id="address2" placeholder="Address 2"
								value="{{ old('address2', '' ) }}"
								required/>
							@error('address2')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Zip</label>
							<input type="text" class="form-control @error('zip') is-invalid @enderror"
								name="zip" id="zip" placeholder="1234"
								value="{{ old('zip', '' ) }}"
								required/>
							@error('zip')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">State</label>
							<input type="text" class="form-control @error('state') is-invalid @enderror"
								name="state" id="state" placeholder="N/A"
								value="{{ old('state', '' ) }}"
								required/>
							@error('state')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Country</label>
							<input type="text" class="form-control @error('country') is-invalid @enderror"
								name="country" id="country" placeholder="bd"
								value="{{ old('country', '') }}"
								required/>
							@error('country')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>


				</div>
			</div>
		</div>
		<!-- end col -->
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Dropdowns</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
				</div>
				<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Code</label>
							<input type="text" class="form-control @error('code') is-invalid @enderror"
								name="code" id="code" placeholder="XX01"
								style="text-transform: uppercase"
								value="{{ old('code', '' ) }}"
								required/>
							@error('code')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>


						<div class="mb-3">
							<label class="form-label">User</label>
							<select class="form-control" name="user_id" required>
								<option value=""><< User >> </option>
								@foreach ($users as $user)
									<option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }} >{{ $user->name }} </option>
								@endforeach
							</select>
							@error('user_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Role</label>
							<select class="form-control js-example-basic-single" name="my_enum" required>
								<option value=""><< Role >> </option>
								<option value="user"	{{ 'user' == old('my_enum') ? 'selected' : '' }}>User</option>
								<option value="agent"	{{ 'agent' == old('my_enum') ? 'selected' : '' }}>Agent</option>
								<option value="admin"	{{ 'admin' == old('my_enum') ? 'selected' : '' }}>Admin</option>
								<option value="system"	{{ 'system' == old('my_enum') ? 'selected' : '' }}>System</option>
							</select>
						</div>


				</div>
			</div>
		</div>
		<!-- end col -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Amount</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
				</div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label">Qty</label>
						<input type="number" class="form-control @error('qty') is-invalid @enderror"
							name="qty" id="qty" placeholder="1"
							value="{{ old('qty', '1' ) }}"
							min="1" required/>
						@error('qty')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>

					<div class="mb-3">
						<label class="form-label">Amount</label>
						<input type="number" class="form-control @error('amount') is-invalid @enderror"
							name="amount" id="amount" placeholder="XX01"
							value="{{ old('amount', '1.00' ) }}"
							step='0.01' min="1" required/>
						@error('amount')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>


				</div>
			</div>
		</div>
		<!-- end col -->
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Profile Image</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
				</div>
				<div class="card-body">

					<div class="mb-3">
						<x-tenant.attachment.create  />
					</div>

					<div class="mb-3">
						<label class="form-label">Notes</label>
						<textarea class="form-control" name="notes"  placeholder="Enter ..." rows="3">{{ old('notes', 'Enter ...') }}</textarea>
					</div>
				</div>
			</div>
		</div>
		<!-- end col -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Date</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
				</div>
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label">Date</label>
						<input type="date" class="form-control @error('my_date') is-invalid @enderror"
							name="my_date" id="my_date" placeholder=""
							value="{{ old('my_date', date('Y-m-d') ) }}"
							required/>
						@error('my_date')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>

					<div class="mb-3">
						<label class="form-label">Date</label>
						<input type="date" class="form-control @error('my_date_time') is-invalid @enderror"
							name="my_date_time" id="my_date_time" placeholder=""
							value="{{ old('my_date_time', date('Y-m-d') ) }}"
							required/>
						@error('my_date_time')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>

					<div class="mb-3">
						<label class="form-check m-0">
						<input type="checkbox" class="form-check-input"
						name="my_bool" id="my_bool"  checked=""/>

						<span class="form-check-label"> Active?</span>
						</label>
					</div>
				</div>
			</div>
		</div>
		<!-- end col -->
	</div>
	<!-- end row -->
</form>
<!-- /.form end -->

@endsection