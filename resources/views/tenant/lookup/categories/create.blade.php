@extends('layouts.tenant.app')
@section('title','Category')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Category
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>


	<!-- form start -->
	<form id="myform" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('categories.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
				</div>
				<h5 class="card-title">Category Info</h5>
				<h6 class="card-subtitle text-muted">Create new Category</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.create.name/>

						<x-tenant.buttons.show.save/>

					</tbody>
				</table>
			</div>
		</div>



	</form>
	<!-- /.form end -->

@endsection
