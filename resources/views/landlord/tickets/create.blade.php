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

			</div>
			<!-- End Body -->

			<x-landlord.create.save/>
		</form>
		<!-- /.form end -->
	</div>
	<!-- End Card -->
		  

@endsection


