@extends('layouts.landlord-app')
@section('title','Edit Service')
@section('breadcrumb','Edit Service')

@section('content')

	<x-landlord.card.header title="Edit Service"/>
	<!-- form start -->
	<form action="{{ route('services.update',$service->id) }}" method="POST">
	@csrf
	@method('PUT')
		<!-- my-section-row -->
		<div class="row my-section-row justify-content-between">
			<div class="col-xl-7">
					<h6>Service Info:-</h6>
					<x-landlord.show.my-text     value="{{ $service->summary }}"/>
					<x-landlord.show.my-text     value="{{  $service->name }}" label="Name"/>
					<x-landlord.show.my-enable   value="{{ $service->enable }}"/>
					<x-landlord.show.my-badge    value="{{ $service->id }}" label="ID"/>
			</div>
			<div class="col-xl-5">
				<h6>Dates and Price:-</h6>
				<x-landlord.show.my-date value="{{ $service->created_at }}" label="Created At:"/>
				<x-landlord.show.my-date value="{{ $service->start_date }}" label="Start Date"/>
				<x-landlord.show.my-date value="{{ $service->end_date }}" label="End Date"/>
				<x-landlord.show.my-number value="{{  $service->price }}" label="Price"/>
			</div>
		</div>
		<!-- /.my-section-row -->

		<div class="my-section-buttons">
			<div class="d-grid gap-2 d-md-flex justify-content-md-end">
				<a class="btn btn-dark" href="{{ route('users.index') }}">Cancel</a>
				<button type="submit" class="btn btn-info">Save</button>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection


@section('sidebar')
<a href="{{ route('services.create') }}" class="btn btn-primary btn-sidebar">Create Service</a>
<a href="{{ route('services.index') }}" class="btn btn-secondary btn-sidebar">Service Lists</a>
<a href="{{ route('services.index',$service->id) }}" class="btn btn-success btn-sidebar">Edit Service</a>
<a href="{{ route('dashboards.index') }}" class="btn btn-dark btn-sidebar">Dashboard</a>
@endsection



