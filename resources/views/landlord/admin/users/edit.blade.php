@extends('layouts.landlord.app')
@section('title','Edit User Profile')
@section('breadcrumb','Edit User Profile')

@section('content')

	<a href="{{ route('users.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New User</a>
	<h1 class="h3 mb-3">Edit User Profile</h1>

	<!-- form start -->
	<form id="myform" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<input type="hidden" name="id" value="{{ $user->id }}">

		<!-- content -->
		@include('landlord.includes.card-edit-user-profile')
		<!-- /.content -->
	</form>
	<!-- /.form end -->

@endsection
