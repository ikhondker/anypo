@extends('layouts.landlord-app')
@section('title','User')
@section('breadcrumb','Create User')

@section('content')
	<!-- Card -->
	<div class="card">
		<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Create User</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">
				<x-landlord.create.name/>
				<x-landlord.create.email/>
				<x-landlord.create.cell/>

				<!-- List Group -->
				<div class="list-group list-group-flush list-group-no-gutters">
					<!-- Item -->
					<div class="list-group-item">
						<!-- Form Switch -->
						<label class="form-check form-switch" for="admin">
							<input class="form-check-input mt-0" type="checkbox" id="admin" name="admin">
							<span class="d-block"> Make this person an Admin</span>
							<span class="d-block small text-muted">Be careful! This user will be able to perform all admin activities</span>
						</label>
					  <!-- End Form Switch -->
					</div>
					<!-- End Item -->
				</div>
				<!-- End List Group -->

			</div>
			<!-- End Body -->


			<x-landlord.create.save/>
		</form>
	</div>
	<!-- End Card -->
@endsection



@section('bo04-content')

	<x-landlord.card.header title="Create User"/>

	{{-- <div class="p-4 border-bottom">
		<h4 class="title mb-0">Create User</h4>
	</div> --}}

	<!-- form start -->
	<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
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
				<h6>User Info:-</h6>



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
				<a class="btn btn-dark" href="{{ route('users.index') }}">Cancel</a>
				<button type="submit" class="btn btn-info">Save</button>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection


@section('sidebar')
	<a href="{{ route('users.create') }}" class="btn btn-primary btn-sidebar">Create User</a>
	<a href="{{ route('users.index') }}" class="btn btn-secondary btn-sidebar">User Lists</a>
	<a href="{{ route('tickets.index') }}" class="btn btn-success btn-sidebar">Ticket Lists</a>
	<a href="{{ route('dashboards.index') }}" class="btn btn-dark btn-sidebar">Dashboard</a>
@endsection
