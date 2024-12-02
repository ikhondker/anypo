@extends('layouts.tenant.app')
@section('title','View Item Category')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('item-categories.index') }}" class="text-muted">Item Categories</a></li>
	<li class="breadcrumb-item active">{{ $itemCategory->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Item Category
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.item-category-actions itemCategoryId="{{ $itemCategory->id }}"/>
		@endslot
	</x-tenant.page-header>

<x-tenant.widgets.who-when model="ItemCategory" articleId="{{ $itemCategory->id  }}"/>

<x-tenant.widgets.back-to-list model="ItemCategory"/>

@endsection

