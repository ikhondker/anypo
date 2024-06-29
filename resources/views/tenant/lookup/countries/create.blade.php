@extends('layouts.tenant.app')
@section('title','Country')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('countries.index') }}">Countries</a></li>
	<li class="breadcrumb-item active">Create Country</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Country
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Country"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Country Info</h5>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Country Code</label>
							<input type="text" class="form-control @error('country') is-invalid @enderror"
								name="country" id="country" placeholder="XX"
								style="text-transform: uppercase"
								value="{{ old('country', '' ) }}"
								required/>
							@error('country')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Country Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror"
								name="name" id="name" placeholder="Country Name"
								value="{{ old('name', '' ) }}"
								required/>
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

			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection