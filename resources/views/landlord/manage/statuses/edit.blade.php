@extends('layouts.landlord.app')
@section('title','Edit Status')
@section('breadcrumb','Edit Status')

@section('content')
	<!-- Card -->
	<div class="card">

		<form id="myform" action="{{ route('statuses.update',$status->code) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')

			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Edit Status</h5>
				<button class="btn btn-primary btn-sm" type="submit" form="myform"><i class="bi bi-save"></i> Save</button>
			</div>

			<!-- Body -->
			<div class="card-body">

				<x-landlord.edit.id-read-only :value="$status->code"/>
				<x-landlord.edit.name :value="$status->name"/>
				<!-- Form -->
				<div class="row mb-4">
					<label for="badge" class="col-sm-3 col-form-label form-label">Badge :</label>
					<div class="col-sm-9">
					<input type="text" class="form-control @error('badge') is-invalid @enderror"
							name="badge" id="badge" placeholder="badge"
							value="{{ old('badge', $status->badge ) }}"
							required/>
						@error('badge')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<!-- End Form -->


			</div>
			<!-- End Body -->

			<x-landlord.edit.save/>
		</form>
	</div>
	<!-- End Card -->
@endsection
