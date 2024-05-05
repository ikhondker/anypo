@extends('layouts.app')
@section('title','Profile')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.profile') }}">{{ $user->name }}</a></li>
	<li class="breadcrumb-item active">Profile</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			My Profile 
		@endslot
		@slot('buttons')
			<x-tenant.actions.profile-actions/>

		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-md-4 col-xl-3">
			<x-tenant.widgets.user.user-profile id="{{ $user->id }}"/>	
		</div>
	
		<div class="col-md-8 col-xl-9">
			<x-tenant.widgets.user.user-detail id="{{ $user->id }}"/>	
		</div>
	</div>
		
	
@endsection

