@extends('layouts.landlord-app')
@section('title','Edit Unhandled Error Log')
@section('breadcrumb','Edit Unhandled Error Log')

@section('content')
	<!-- Card -->
	<div class="card">
		<form id="myform"  action="{{ route('error-logs.update',$errorLog->id) }}" method="POST">
			@csrf
			@method('PUT')

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Edit Unhandled Error Log</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">
				<x-landlord.edit.id-read-only :value="$errorLog->id"/>
				<x-landlord.show.my-text	value="{{ $errorLog->tenant }}"/>
				<x-landlord.show.my-text	value="{{ $errorLog->user_id }}" label="User"/>
				<x-landlord.show.my-text	value="{{ $errorLog->role }}" label="Role"/>
				<x-landlord.show.my-date value="{{ $errorLog->created_at }}" label="Created At:"/>

			</div>
			<!-- End Body -->

			<x-landlord.edit.save/>
		</form>
	</div>
	<!-- End Card -->
@endsection


