@extends('layouts.app')
@section('title','Category')
@section('breadcrumb','Create Category')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Category
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Category"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">Category Info</h5>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Category Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror"
								name="name" id="name" placeholder="Category Name"
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