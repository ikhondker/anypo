@extends('layouts.landlord.app')
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



