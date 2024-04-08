@extends('layouts.app')
@section('title','Users')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
	<li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Users
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="User"/>
			<x-tenant.buttons.header.create object="User"/>
			<x-tenant.buttons.header.edit object="User" :id="$user->id"/>
			<x-tenant.buttons.header.password :id="$user->id"/>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">User Key Informations</h5>
					<h6 class="card-subtitle text-muted">User's Key Information.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $user->name }}"/>
					<x-tenant.show.my-email		value="{{ $user->email }}"/>
					<x-tenant.show.my-text		value="{{ $user->cell }}" label="Cell"/>
					<x-tenant.show.my-text		value="{{ $user->designation->name }}" label="Title"/>
					<x-tenant.show.my-text		value="{{ $user->dept->name }}" label="Dept"/>
					<x-tenant.show.my-badge		value="{{ $user->role }}" label="Role"/>
					<x-tenant.show.my-boolean	value="{{ $user->enable }}"/>
					<x-tenant.buttons.show.edit object="User" :id="$user->id"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">User Avatar</h5>
					<h6 class="card-subtitle text-muted">User's Avatar.</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Avatar:</span>
						</div>
						<div class="col-sm-9">
								{{-- <x-tenant.show.avatar avatar="{{ $user->avatar }}"/> --}}
								<img src="{{ Storage::disk('s3t')->url('avatar/'.$user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle rounded me-2 mb-2" title="{{ $user->name }}" width="120px">
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">User Address</h5>
					<h6 class="card-subtitle text-muted">User's Address.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text value="{{ $user->address1 }}" label="Address1"/>
					<x-tenant.show.my-text value="{{ $user->address2 }}" label="Address2"/>
					<x-tenant.show.my-text value="{{ $user->city.', '.$user->state.', '.$user->zip  }}" label="City"/>
					<x-tenant.show.my-text value="{{ $user->country_name->name }}" label="Country"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Other Details</h5>
					<h6 class="card-subtitle text-muted">User's Other Details.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-date-time	value="{{ $user->email_verified_at }}" label="Verified"/>
					<x-tenant.show.my-date-time	value="{{ $user->last_login_at }}" label="Last Login"/>
					<x-tenant.show.my-text		value="{{ $user->last_login_ip }}" label="Last IP"/>
					<x-tenant.show.my-url		value="{{ $user->facebook }}" label="Facebook"/>
					<x-tenant.show.my-url		value="{{ $user->linkedin }}" label="LinkedIn"/>
				</div>
			</div>

		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-6">

		</div>
		<!-- end col-6 -->
		<div class="col-6">

		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

