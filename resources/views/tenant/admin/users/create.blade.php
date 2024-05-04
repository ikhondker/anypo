@extends('layouts.app')
@section('title','User')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create User
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="User"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">Create User</h5>
					<h6 class="card-subtitle text-muted">Create a New User.</h6>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Email</label> <x-tenant.info info="Note: You wont be able to change the email."/>
							<input type="email" class="form-control @error('email') is-invalid @enderror"
								name="email" id="email" placeholder="name@company.com"
								value="{{ old('email', 'email@example.com' ) }}"
								required/>
							@error('email')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
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
							<label class="form-label text-danger">Role</label>
							<select class="form-control" name="role" required>
								<option value=""><< Role >> </option>
								<option value="{{ UserRoleEnum::USER->value }}" {{ UserRoleEnum::USER->value == old('role') ? 'selected' : '' }}>User</option>
								<option value="{{ UserRoleEnum::BUYER->value }}" {{ UserRoleEnum::BUYER->value == old('role') ? 'selected' : '' }}>Buyer</option>
								<option value="{{ UserRoleEnum::HOD->value }}" {{ UserRoleEnum::HOD->value == old('role') ? 'selected' : '' }}>HoD</option>
								<option value="{{ UserRoleEnum::CXO->value }}" {{ UserRoleEnum::CXO->value == old('role') ? 'selected' : '' }}>CxO</option>
								<option value="{{ UserRoleEnum::ADMIN->value }}" {{ UserRoleEnum::ADMIN->value == old('role') ? 'selected' : '' }}>Admin</option>
							</select>
						</div>

						<x-tenant.buttons.show.save/>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">

			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection