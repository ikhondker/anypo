@extends('layouts.landlord.app')
@section('title','Menu')
@section('breadcrumb','Create Menu')

@section('content')
	<!-- Card -->
	<div class="card">
		<form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Create Menu</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">

				<!-- Form -->
				<div class="row mb-4">
					<label for="raw_route_name" class="col-sm-3 col-form-label form-label">raw_route_name X:</label>
					<div class="col-sm-9">
					<input type="text" class="form-control @error('raw_route_name') is-invalid @enderror"
							name="raw_route_name" id="raw_route_name" placeholder="Summary"
							value="{{ old('raw_route_name', '' ) }}"
							required/>
						@error('raw_route_name')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<!-- End Form -->

				<!-- Form -->
				<div class="row mb-4">
					<label for="route_name" class="col-sm-3 col-form-label form-label">route_name X:</label>
					<div class="col-sm-9">
					<input type="text" class="form-control @error('route_name') is-invalid @enderror"
							name="route_name" id="route_name" placeholder="Summary"
							value="{{ old('route_name', '' ) }}"
							required/>
						@error('route_name')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<!-- End Form -->

				<!-- Form -->
				<div class="row mb-4">
					<label for="access" class="col-sm-3 col-form-label form-label">Access X:</label>
					<div class="col-sm-9">
					<input type="text" class="form-control @error('access') is-invalid @enderror"
							name="access" id="access" placeholder="Summary"
							value="{{ old('access', '' ) }}"
							required/>
						@error('access')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<!-- End Form -->

			</div>
			<!-- End Body -->


			<x-landlord.create.save/>
		</form>
	</div>
	<!-- End Card -->
@endsection


