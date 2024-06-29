@extends('layouts.tenant.app')
@section('title','Edit Country')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('countries.index') }}">Countries</a></li>
	<li class="breadcrumb-item active">{{ $country->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Country
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Country"/>
			<x-tenant.buttons.header.create object="Country"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('countries.update',$country->country) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Country Info</h5>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">Code</label>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('country', $country->country ) }}" readonly>
							</div>

							<div class="mb-3">
								<label class="form-label">Country Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Country Name"
									value="{{ old('name', $country->name ) }}"
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

				<div class="col-6">
					<div class="card">

					</div>
				</div>
				<!-- end col-6 -->
			</div>


	</form>
	<!-- /.form end -->
@endsection

