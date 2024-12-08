@extends('layouts.tenant.app')
@section('title','User')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-muted">Users</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create User
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="User"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">

				</div>
				<h5 class="card-title">Create User</h5>
				<h6 class="card-subtitle text-muted">Create a New User.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th width="25%">Email :<x-tenant.info info="Note: You wont be able to change the email."/></th>
							<td>
								<input type="email" class="form-control @error('email') is-invalid @enderror"
									name="email" id="email" placeholder="you@example.com"
									value="{{ old('email', 'you@example.com' ) }}"
									required/>
								@error('email')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>Full Name :</th>
							<td>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Full Name"
									value="{{ old('name', '' ) }}"
									required/>
								@error('name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>Role :</th>
							<td>
								<select class="form-control" name="role" required>
									<option value=""><< Role >> </option>
									<option value="{{ UserRoleEnum::USER->value }}" {{ UserRoleEnum::USER->value == old('role') ? 'selected' : '' }}>User</option>
									<option value="{{ UserRoleEnum::BUYER->value }}" {{ UserRoleEnum::BUYER->value == old('role') ? 'selected' : '' }}>Buyer</option>
									<option value="{{ UserRoleEnum::HOD->value }}" {{ UserRoleEnum::HOD->value == old('role') ? 'selected' : '' }}>HoD</option>
									<option value="{{ UserRoleEnum::CXO->value }}" {{ UserRoleEnum::CXO->value == old('role') ? 'selected' : '' }}>CxO</option>
									<option value="{{ UserRoleEnum::ADMIN->value }}" {{ UserRoleEnum::ADMIN->value == old('role') ? 'selected' : '' }}>Admin</option>
								</select>
							</td>
						</tr>
						<x-tenant.create.save/>
					</tbody>
				</table>
			</div>
		</div>



	</form>
	<!-- /.form end -->

@endsection
