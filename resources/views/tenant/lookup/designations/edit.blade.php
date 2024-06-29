@extends('layouts.tenant.app')
@section('title','Edit Designation')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('designations.index') }}">Designations</a></li>
	<li class="breadcrumb-item"><a href="{{ route('designations.show',$designation->id) }}">{{ $designation->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Designation
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Designation"/>
			<x-tenant.buttons.header.create object="Designation"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('designations.update',$designation->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Designation</h5>
							<h6 class="card-subtitle text-muted">Edit a designations</h6>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">Designation Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Designation Name"
									value="{{ old('name', $designation->name ) }}"
									/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.buttons.show.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->

			</div>


	</form>
	<!-- /.form end -->
@endsection

