@extends('layouts.tenant.app')
@section('title','Edit Item Category')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
	<li class="breadcrumb-item">{{ $category->name }}</li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Item Category
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
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Item Category</h5>
							<h6 class="card-subtitle text-muted">Edit an Item Category.</h6>
						</div>
						<div class="card-body">

							<x-tenant.edit.name :value="$category->name"/>

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

