@extends('layouts.landlord.app')
@section('title','Category')
@section('breadcrumb','Create Category')

@section('content')
	<!-- Card -->
	<div class="card">
		<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Create Category</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">
				<x-landlord.create.name/>

			</div>
			<!-- End Body -->


			<x-landlord.create.save/>
		</form>
	</div>
	<!-- End Card -->
@endsection

