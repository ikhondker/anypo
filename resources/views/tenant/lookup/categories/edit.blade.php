@extends('layouts.app')
@section('title','Edit Category')
@section('breadcrumb','Edit Category')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Category
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Category"/>
			<x-tenant.buttons.header.create object="Category"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Category Info</h5>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">ID</label>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $category->id ) }}" readonly>
							</div>

							<div class="mb-3">
								<label class="form-label">Category Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Category Name"
									value="{{ old('name', $category->name ) }}"
									/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.widgets.submit/>

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

