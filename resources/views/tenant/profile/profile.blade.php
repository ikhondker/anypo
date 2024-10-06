@extends('layouts.tenant.app')
@section('title','Profile')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.profile') }}" class="text-muted">{{ $user->name }}</a></li>
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
		<div class="col-md-5 col-xl-4">
			<x-tenant.widgets.user.user-profile userId="{{ $user->id }}"/>
		</div>

		<div class="col-md-7 col-xl-8">
			<x-tenant.widgets.user.user-detail userId="{{ $user->id }}"/>
		</div>
	</div>


@endsection

