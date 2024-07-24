@extends('layouts.tenant.app')
@section('title','Edit Item Category')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-muted">Categories</a></li>
	<li class="breadcrumb-item">{{ $category->name }}</li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Item Category
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.category-actions id="{{ $category->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('categories.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Create</a>
					<a href="{{ route('categories.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Edit Item Category</h5>
				<h6 class="card-subtitle text-muted">Edit an Item Category.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.edit.name :value="$category->name"/>

						<x-tenant.buttons.show.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->
@endsection

