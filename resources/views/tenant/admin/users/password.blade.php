@extends('layouts.app')
@section('title','Change Password')
@section('breadcrumb','Change Password')


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Change Password
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="User"/>
			<x-tenant.buttons.header.lists object="User"/>
		@endslot
	</x-tenant.page-header>

	 <!-- form start -->
	 <form action="{{ route('users.changepass',['user'=>$user->id]) }}" method="POST">
		@csrf
		

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Change Password</h5>
						<h6 class="card-subtitle text-muted">Change User's Password.</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">New password</label>
							<input class="form-control form-control-lg  @error('password1') is-invalid @enderror" 
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
							<input class="form-control form-control-lg  @error('password2') is-invalid @enderror" 
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
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">User Info</h5>
						<h6 class="card-subtitle text-muted">User's Basic Information.</h6>
					</div>
					<div class="card-body">
						
						<div class="row mb-3">
							<div class="col-sm-3 text-end">
								<span class="h6 text-secondary">Avatar:</span>
							</div>
							<div class="col-sm-9">
								<img src="{{ Storage::disk('s3ta')->url($user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle rounded me-2 mb-2" title="{{ $user->name }}" width="120px">
								{{-- <x-tenant.show.avatar avatar="{{ $user->avatar }}"/> --}}
							</div>
						</div>

						<x-tenant.show.my-text	value="{{ $user->name }}"/>
						<x-tenant.show.my-badge	value="{{ $user->role }}" label="Role"/>
						{{-- <x-tenant.show.my-badge	value="{{ $user->id }}" label="ID"/> --}}
					</div>
				</div>
			</div>
		</div>

		
	</form>
	<!-- /.form end -->
@endsection



