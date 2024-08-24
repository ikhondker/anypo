@extends('layouts.tenant.app')
@section('title','View Category')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-muted">Departments</a></li>
	<li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Category
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.category-actions categoryId="{{ $category->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('categories.edit', $category->id ) }}"><i class="fas fa-edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('categories.index') }}" ><i class="fas fa-list"></i> View all</a>
			</div>
			<h5 class="card-title">Category Detail</h5>
			<h6 class="card-subtitle text-muted">Category details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $category->name }}"/>
					<x-tenant.show.my-boolean	value="{{ $category->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $category->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $category->created_at }}"/>

				</tbody>
			</table>
		</div>
	</div>

@endsection

