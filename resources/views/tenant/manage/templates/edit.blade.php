@extends('layouts.app')
@section('title','Edit Template')
@section('breadcrumb','Edit Templates v1.3 (8-MAY-23)')


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Template
		@endslot
		@slot('buttons')
			<button class="btn btn-primary me-1" type="submit" form="myform"><i class="fas fa-save"></i> Save</button>
			{{-- <input type="submit" form="myform" value="Update1" class="btn btn-primary float-end me-2"/> --}}
			<x-tenant.buttons.header.lists object="Template"/>
			<a href="{{ route('templates.create') }}" class="btn btn-primary float-end me-1"><i class="fas fa-plus"></i> Create Template</a>

		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('templates.update',$template->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Template Info</h5>
							<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout.</h6>
						</div>
						<div class="card-body">

								<div class="mb-3">
									<label class="form-label">ID</label>
									<input type="text" class="form-control" placeholder="ID" value="{{ old('id', $template->id ) }}" readonly>
								</div>

								<div class="mb-3">
									<label class="form-label">Full Name</label>
									<input type="text" class="form-control @error('name') is-invalid @enderror"
										name="name" id="name" placeholder="Full Name"
										value="{{ old('name', $template->name ) }}"
										required/>
									@error('name')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3">
									<label class="form-label">Summary</label>
									<input type="text" class="form-control @error('summary') is-invalid @enderror"
										name="summary" id="summary" placeholder="Summary"
										value="{{ old('summary', $template->summary ) }}"
										required/>
									@error('summary')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
								<div class="mb-3">
									<label class="form-label">Email</label>
									<input type="email" class="form-control @error('email') is-invalid @enderror"
										name="email" id="email" placeholder="name@company.com"
										value="{{ old('email', $template->email ) }}"
										required/>
									@error('email')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>


								<div class="mb-3">
									<label class="form-label">Cell</label>
									<input type="text" class="form-control @error('cell') is-invalid @enderror"
										name="cell" id="cell" placeholder="01911310509"
										value="{{ old('cell', $template->cell ) }}"
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
										value="{{ old('address1', $template->address1 ) }}"
										required/>
									@error('address1')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>

								<div class="mb-3">
									<label class="form-label">Address 2</label>
									<input type="text" class="form-control @error('address2') is-invalid @enderror"
										name="address2" id="address2" placeholder="Address 2"
										value="{{ old('address2', $template->address2 ) }}"
										required/>
									@error('address2')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>

								<div class="mb-3">
									<label class="form-label">Zip</label>
									<input type="text" class="form-control @error('zip') is-invalid @enderror"
										name="zip" id="zip" placeholder="1234"
										value="{{ old('zip', $template->zip ) }}"
										required/>
									@error('zip')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>

								<div class="mb-3">
									<label class="form-label">State</label>
									<input type="text" class="form-control @error('state') is-invalid @enderror"
										name="state" id="state" placeholder="N/A"
										value="{{ old('state', $template->state ) }}"
										required/>
									@error('state')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>

								<div class="mb-3">
									<label class="form-label">Country</label>
									<select class="form-control" name="country">
										@foreach ($countries as $country)
											<option {{ $country->country == old('country',$template->country) ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->name }} </option>
										@endforeach
									</select>
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
										value="{{ old('code', $template->code ) }}"
										required/>
									@error('code')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>


								<div class="mb-3">
									<label class="form-label">User</label>
									<select class="form-control" name="user_id">
										@foreach ($users as $user)
										<option {{ $user->id == old('user_id',$template->user_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
										@endforeach
									</select>
								</div>

								<div class="mb-3">
									<label class="form-label">Role</label>
									<select class="form-control" name="my_enum" placeholder="Enum" value="user">
										<option {{ 'user' == old('my_enum',$template->my_enum) ? 'selected' : '' }}  value="user"  >User</option>
										<option {{ 'agent' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="agent">Agent</option>
										<option {{ 'admin' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="admin">Admin</option>
										<option {{ 'system' == old('my_enum',$template->my_enum) ? 'selected' : '' }} value="system">System</option>
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
									value="{{ old('qty', $template->qty ) }}"
									min="1" required/>
								@error('qty')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Amount</label>
								<input type="number" class="form-control @error('amount') is-invalid @enderror"
									name="amount" id="amount" placeholder="XX01"
									value="{{ old('amount', $template->amount ) }}"
									step='0.01' min="1" required/>
								@error('amount')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">Notes:</label>
								<textarea class="form-control" name="notes"  placeholder="Enter ..." rows="3">{{ old('notes', $template->notes) }}</textarea>
								@error('notes')
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
								<textarea class="form-control" name="notes"  placeholder="Enter ..." rows="3">{{ old('notes', $template->notes) }}</textarea>
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
									value="{{ old('my_date', $template->my_date->toDateString() ) }}"
									required/>
								@error('my_date')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Date</label>
								<input type="date" class="form-control @error('my_date_time') is-invalid @enderror"
									name="my_date_time" id="my_date_time" placeholder=""
									value="{{ old('my_date_time', $template->my_date_time->toDateString() ) }}"
									required/>
								@error('my_date_time')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-check m-0">
								<input type="checkbox" class="form-check-input"
								name="my_bool" id="my_bool" @checked($template->my_bool)/>
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

