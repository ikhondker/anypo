@extends('layouts.tenant.app')
@section('title','Edit Profile')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('users.profile') }}" class="text-muted">{{ $user->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Profile
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
			<!-- form start -->
			<form id="myform" action="{{ route('users.profile-update',$user->id) }}" method="POST" enctype="multipart/form-data">
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

