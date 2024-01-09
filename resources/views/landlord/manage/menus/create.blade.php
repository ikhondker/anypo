@extends('layouts.landlord-app')
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

@section('bo04-content')

	<x-landlord.card.header title="Create Menu"/>

	{{-- <div class="p-4 border-bottom">
		<h4 class="title mb-0">Create Menu</h4>
	</div> --}}

	<!-- form start -->
	<form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<!-- my-section-row -->
		<div class="row my-section-row justify-content-between">
			<div class="col-xl-6">
				<h6>Login Info:-</h6>

				<div class="form-group row">
					<label for="email" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
					<div class="col-sm-9">
						<input type="email" class="form-control form-control-sm"
							name="email" id="email" placeholder="name@example.com"
							value="{{ old('email', "name@example.com" ) }}"
							class="@error('email') is-invalid @enderror" required>
						@error('email')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="name" class="col-sm-3 col-form-label col-form-label-sm">Full Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm"
							name="name" id="name" placeholder="John Doe"
							value="{{ old('name', "" ) }}"
							class="@error('name') is-invalid @enderror" required>
							@error('name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="admin" class="col-sm-3 col-form-label col-form-label-sm">Admin?</label>
					<div class="col-sm-9">
						<input class="form-check-input me-3" type="checkbox" id="form-check-default" name="admin">
						<label class="" for="form-check-default">
							Make this person an Admin
						</label>
						@error('admin')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>



			</div>

			<div class="col-xl-6">
				<h6>Menu Info:-</h6>



				<div class="form-group row">
					<label for="cell" class="col-sm-3 col-form-label col-form-label-sm">Cell</label>
					<div class="col-sm-9">
						<input type="text" class="form-control form-control-sm"
							name="cell" id="cell" placeholder="01911-"
							value="{{ old('cell', "01911-" ) }}"
							class="@error('cell') is-invalid @enderror" required>
						@error('cell')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>




			</div>
		</div>
		<!-- /.my-section-row -->


		<div class="my-section-buttons">
			<div class="d-grid gap-2 d-md-flex justify-content-md-end">
				<a class="btn btn-dark" href="{{ route('menus.index') }}">Cancel</a>
				<button type="submit" class="btn btn-info">Save</button>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection


@section('sidebar')
	<a href="{{ route('menus.create') }}" class="btn btn-primary btn-sidebar">Create Menu</a>
	<a href="{{ route('menus.index') }}" class="btn btn-secondary btn-sidebar">Menu Lists</a>
	<a href="{{ route('tickets.index') }}" class="btn btn-success btn-sidebar">Ticket Lists</a>
	<a href="{{ route('dashboards.index') }}" class="btn btn-dark btn-sidebar">Dashboard</a>
@endsection
