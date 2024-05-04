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
			<x-tenant.actions.user-actions id="{{ $user->id }}"/>
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

	@include('shared.includes.js.sw2-advance')
@endsection

