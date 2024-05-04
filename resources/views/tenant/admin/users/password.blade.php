@extends('layouts.app')
@section('title','Change Password')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
	<li class="breadcrumb-item active">Change Password</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Change Password
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="User"/>
			<x-tenant.actions.user-actions id="{{ $user->id }}"/>
		@endslot
	</x-tenant.page-header>

	 <!-- form start -->
	 <form action="{{ route('users.password-update',['user'=>$user->id]) }}" method="POST">
		@csrf


		<div class="row">
			<div class="col-md-4 col-xl-3">
				<x-tenant.widgets.user.user-profile id="{{ $user->id }}"/>
			</div>

			<div class="col-md-8 col-xl-9">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Change Password</h5>
						<h6 class="card-subtitle text-muted">Change User's Password.</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">New password</label>
							<input class="form-control form-control-lg @error('password1') is-invalid @enderror"
								type="password" name="password1" id="password1"
								placeholder="New password"
								value="{{ old('password1', $user->password1 ) }}"
								required/>
								@error('password1')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Confirm Password</label>
							<input class="form-control form-control-lg @error('password2') is-invalid @enderror"
								type="password" name="password2" id="password2"
								value="{{ old('password2', $user->password2 ) }}"
								placeholder="Retype password"
								required autocomplete="new-password"/>
								@error('password2')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
						</div>
							<x-tenant.buttons.show.save/>
					</div>
				</div>

			</div>
		</div>


	</form>
	<!-- /.form end -->
@endsection



