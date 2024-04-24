@extends('layouts.app')
@section('title','Profile')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
	<li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Profile
		@endslot
		@slot('buttons')
			<x-tenant.actions.user-actions id="{{ $user->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.user-profile  id="{{ $user->id }}"/>

	@include('shared.includes.js.sw2-advance')
@endsection

