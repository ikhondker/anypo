@extends('layouts.tenant.app')
@section('title','Edit Item Category')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-muted">Categories</a></li>
	<li class="breadcrumb-item">{{ $itemCategory->name }}</li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Item Category
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.item-category-actions itemCategoryId="{{ $itemCategory->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('item-categories.update',$itemCategory->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('item-categories.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
					<a href="{{ route('item-categories.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Edit Item Category</h5>
				<h6 class="card-subtitle text-muted">Edit an Item Category.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.edit.name :value="$itemCategory->name"/>
						<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->
@endsection

