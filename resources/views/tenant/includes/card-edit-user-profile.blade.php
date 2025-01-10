<div class="card">
	<div class="card-header">
		@can('viewAny', $user)
			<div class="card-actions float-end">
				{{-- <a href="{{ route('users.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a> --}}
				{{-- <a href="{{ route('users.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a> --}}
			</div>
		@endcan
		<h5 class="card-title">User Avatar</h5>
		<h6 class="card-subtitle text-muted">User's Avatar.</h6>
	</div>
	<div class="card-body">
		<table class="table table-sm my-2">
			<tbody>
				<tr>
					<th ></th>
					<td>
						<img src="{{ Storage::disk('s3t')->url('avatar/'.$user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle rounded me-2 mb-2" title="{{ $user->name }}" width="120px">
						<x-tenant.attachment.create />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h5 class="card-title">User Key Information's</h5>
		<h6 class="card-subtitle text-muted">User's Key Information.</h6>
	</div>
	<div class="card-body">
		<table class="table table-sm my-2">
			<tbody>
				<tr>
					<th width="25%">Full Name :</th>
					<td>
						<input type="text" class="form-control @error('name') is-invalid @enderror"
							name="name" id="name" placeholder="Full Name"
							value="{{ old('name', $user->name ) }}"
							required/>
						@error('name')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
					</td>
				</tr>
				<tr>
					<th>Email <x-tenant.info info="Note: You wont be able to change the email."/> :</th>
					<td>
						<input type="email" class="form-control @error('email') is-invalid @enderror"
							name="email" id="email" placeholder="you@example.com"
							value="{{ old('email', $user->email ) }}"
							readonly/>
						@error('email')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
					</td>
				</tr>
				<tr>
					<th>Designation :</th>
					<td>
						<select class="form-control" name="designation_id">
							@foreach ($designations as $designation)
								<option {{ $designation->id == old('designation_id',$user->designation_id) ? 'selected' : '' }} value="{{ $designation->id }}">{{ $designation->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<th>Department :</th>
					<td>
						<select class="form-control" name="dept_id">
							@foreach ($depts as $dept)
								<option {{ $dept->id == old('dept_id',$user->dept_id) ? 'selected' : '' }} value="{{ $dept->id }}">{{ $dept->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<th>Cell :</th>
					<td>
						<input type="text" class="form-control @error('cell') is-invalid @enderror"
							name="cell" id="cell" placeholder="(123) 456-7890"
							value="{{ old('cell', $user->cell ) }}"
							required/>
						@error('cell')
							<div class="small text-danger">{{ $message }}</div>
						@enderror
					</td>
				</tr>

			</tbody>
		</table>
	</div>
</div>

@if ( (auth()->user()->isAdmin() || auth()->user()->isSupport() ) && (auth()->user()->id <> $user->id) && (! auth()->user()->isBackend()))
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Role Modify :</h5>
			<h6 class="card-subtitle text-muted">Change User's Role.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<tr>
						<th width="25%" class="text-danger">Modify Role To:</th>
						<td>
							<select class="form-control" name="role">
								<option {{ 'user' == old('role',$user->role->value) ? 'selected' : '' }} value="user">User</option>
								<option {{ 'buyer' == old('role',$user->role->value) ? 'selected' : '' }} value="buyer">Buyer</option>
								<option {{ 'hod' == old('role',$user->role->value) ? 'selected' : '' }} value="hod">HoD</option>
								<option {{ 'cxo' == old('role',$user->role->value) ? 'selected' : '' }} value="cxo">CxO</option>
								<option {{ 'admin' == old('role',$user->role->value) ? 'selected' : '' }} value="admin">Admin</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@endif

<div class="card">
	<div class="card-header">
		<h5 class="card-title">User Address</h5>
		<h6 class="card-subtitle text-muted">User's Address.</h6>
	</div>
	<div class="card-body">
		<table class="table table-sm my-2">
			<tbody>
				<x-tenant.edit.address1 value="{{ $user->address1 }}"/>
				<x-tenant.edit.address2 value="{{ $user->address2 }}"/>
				<x-tenant.edit.city-state-zip city="{{ $user->city }}" state="{{ $user->state }}" zip="{{ $user->zip }}"/>
				<x-tenant.edit.country :value="$user->country"/>
			</tbody>
		</table>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h5 class="card-title">Other Details</h5>
		<h6 class="card-subtitle text-muted">User's Other Details.</h6>
	</div>
	<div class="card-body">
		<table class="table table-sm my-2">
			<tbody>
				<x-tenant.edit.website value="{{ $user->website }}"/>
				<x-tenant.edit.facebook value="{{ $user->facebook }}"/>
				<x-tenant.edit.linked-in value="{{ $user->linkedin }}"/>
				<x-tenant.edit.notes value="{{ $user->notes }}"/>
					<x-tenant.edit.save/>
			</tbody>
		</table>
	</div>
</div>

