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

	<x-tenant.widgets.who-when model="Category" articleId="{{ $category->id }}"/>

	<x-tenant.widgets.back-to-list model="Category"/>

@endsection

