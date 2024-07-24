@extends('layouts.tenant.app')
@section('title','Edit User')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-muted">Users</a></li>
	<li class="breadcrumb-item"><a href="{{ route('users.show',$user->id) }}" class="text-muted">{{ $user->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit User
		@endslot
		@slot('buttons')
			<x-tenant.actions.admin.user-actions id="{{ $user->id }}"/>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<div class="col-md-5 col-xl-4">
			<x-landlord.widgets.user.user-profile id="{{ $user->id }}"/>
		</div>

		<div class="col-md-7 col-xl-8">
			<!-- form start -->
			<form id="myform" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<!-- content -->
				@include('tenant.includes.card-edit-user-profile')
				<!-- /.content -->
				
			</form>
			<!-- /.form end -->
		</div>
	</div>

	
@endsection

