@extends('layouts.landlord.app')
@section('title','Category')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('mail-lists.index') }}" class="text-muted">Mail Lists</a></li>
	<li class="breadcrumb-item active">Create Mail Lists</li>
@endsection


@section('content')
	<!-- Card -->
	<div class="card">
		<form action="{{ route('mail-lists.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Create Category</h5>
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

