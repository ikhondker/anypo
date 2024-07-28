@extends('layouts.landlord.app')
@section('title','Profile')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.profile') }}" class="text-muted">{{ $user->name }}</a></li>
	<li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')

	<a href="{{ route('users.profile-edit') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-edit"></i> Edit Profile</a>
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

