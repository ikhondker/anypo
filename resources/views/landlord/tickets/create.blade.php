@extends('layouts.landlord-app')
@section('title','Create Ticket')
@section('breadcrumb','Create Ticket')


@section('content')


	<!-- Card -->
	<div class="card">
		<!-- form start -->
		<form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Create Ticket</h5>
				{{-- <button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-floppy"></i> Save</button> --}}
			</div>

			<!-- Body -->
			<div class="card-body">
				<x-landlord.create.title/>
				<x-landlord.create.content/>

				<!-- Form -->
				<div class="row mb-4">
					<label for="title" class="col-sm-3 col-form-label form-label">Attachment:</label>
					<div class="col-sm-9">
						<x-landlord.attachment.create />
					</div>
				</div>
				<!-- End Form -->

				<!-- Form -->
				<div class="row mb-4">
					<label for="title" class="col-sm-3 col-form-label form-label">Department:</label>
					<div class="col-sm-9">
						<select class="form-control form-control-sm" name="dept_id" required>
							<option value=""><< Dept >> </option>
							@foreach ($depts as $dept)
								<option value="{{ $dept->id }}" {{ $dept->id == old('dept_id') ? 'selected' : '' }} >{{ $dept->name }} </option>
							@endforeach
						</select>
					</div>
				</div>
				<!-- End Form -->

				<!-- Form -->
				<div class="row mb-4">
					<label for="title" class="col-sm-3 col-form-label form-label">Priority:</label>
					<div class="col-sm-9">
						<select class="form-control form-control-sm" name="priority_id" required>
							<option value=""><< Priority >> </option>
							@foreach ($priorities as $priority)
								<option value="{{ $priority->id }}" {{ $priority->id == old('priority_id') ? 'selected' : '' }} >{{ $priority->name }} </option>
							@endforeach
						</select>
					</div>
				</div>
				<!-- End Form -->


			</div>
			<!-- End Body -->

			<x-landlord.create.save/>
		</form>
		<!-- /.form end -->
	</div>
	<!-- End Card -->
		  

@endsection


