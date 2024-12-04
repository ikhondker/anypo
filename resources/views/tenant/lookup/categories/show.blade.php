@extends('layouts.tenant.app')
@section('title','View PR/PO Category')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-muted">Category</a></li>
	<li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View PR/PO Category
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.category-actions categoryId="{{ $category->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('categories.edit', $category->id ) }}"><i data-lucide="edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('categories.index') }}" ><i class="fas fa-list"></i> View all</a>
			</div>
			<h5 class="card-title">PR/PO Category Detail</h5>
			<h6 class="card-subtitle text-muted">PR/PO Category details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $category->name }}"/>
					<x-tenant.show.my-boolean	value="{{ $category->enable }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

