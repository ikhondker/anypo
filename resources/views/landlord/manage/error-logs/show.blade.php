@extends('layouts.landlord-app')
@section('title','View Unhandled Error Log')
@section('breadcrumb','View Unhandled Error Log')

@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
		<h4 class="card-header-title">View Unhandled Error Log</h4>
		</div>

		<!-- Body -->
		<div class="card-body">
			<x-landlord.show.my-badge		value="{{ $errorLog->id }}" label="ID"/>
			<x-landlord.show.my-text		value="{{ $errorLog->tenant }}" label="Tenant"/>
			<x-landlord.show.my-url			value="{{ $errorLog->url }}"/>
			<x-landlord.show.my-text		value="{{ $errorLog->e_class }}" label="Class"/>
			<x-landlord.show.my-text		value="{{ $errorLog->user_id }}" label="User ID"/>
			<x-landlord.show.my-text		value="{{ $errorLog->role }}" label="Role"/>
			<x-landlord.show.my-date-time	value="{{ $errorLog->created_at }}" label="Created At:"/>
			<x-landlord.show.my-content		value="{{ $errorLog->msg }}" label="Message"/>
		</div>
		<!-- End Body -->

		<!-- Footer -->
		<div class="card-footer pt-0">
		<div class="d-flex justify-content-end gap-3">
			<a class="btn btn-primary" href="{{ route('error-logs.edit',$errorLog->id) }}">Edit</a>
		</div>
		</div>
		<!-- End Footer -->
	</div>
	<!-- End Card -->
@endsection
