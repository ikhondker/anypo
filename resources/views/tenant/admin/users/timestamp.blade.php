@extends('layouts.tenant.app')
@section('title','Users')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-muted">Users</a></li>
	<li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Users
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="User"/>
			<x-tenant.actions.admin.user-actions userId="{{ $user->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.who-when model="User" articleId="{{ $user->id }}"/>

	<x-tenant.widgets.back-to-list model="User"/>

@endsection

