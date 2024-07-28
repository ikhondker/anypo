@extends('layouts.landlord.app')
@section('title', 'Users')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-muted">Users</a></li>
	<li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')

	<a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary float-end mt-n1 "><i class="fas fa-edit"></i> Edit User</a>

	<a href="{{ route('users.create') }}" class="btn btn-primary float-end mt-n1 me-2"><i class="fas fa-plus"></i> New User</a>
	<h1 class="h3 mb-3">User Profile</h1>

	<div class="row">
		<div class="col-md-5 col-xl-4">
			<x-landlord.widgets.user.user-profile id="{{ $user->id }}"/>
		</div>

		<div class="col-md-7 col-xl-8">
			<x-landlord.widgets.user.user-detail id="{{ $user->id }}"/>
		</div>
	</div>

@endsection

