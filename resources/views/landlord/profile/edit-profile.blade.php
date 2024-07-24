@extends('layouts.landlord.app')
@section('title','Edit User')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('users.profile') }}">{{ $user->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Edit Profile</h1>

	<!-- form start -->
	<form id="myform" action="{{ route('users.profile-update',$user->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<!-- content -->
		@include('landlord.includes.card-edit-user-profile')
		<!-- /.content -->

	</form>
	<!-- /.form end -->

@endsection

