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
			<x-tenant.buttons.header.create model="ItemCategory"/>
			<x-tenant.actions.lookup.item-category-actions itemCategoryId="{{ $itemCategory->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('item-categories.edit', $itemCategory->id ) }}"><i data-lucide="edit"></i> Edit</a>
			</div>
			<h5 class="card-title">Category Detail</h5>
			<h6 class="card-subtitle text-muted">Category details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $itemCategory->name }}"/>
					<x-tenant.show.my-boolean	value="{{ $itemCategory->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $itemCategory->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $itemCategory->created_at }}"/>

				</tbody>
			</table>
		</div>
	</div>

	<x-tenant.widgets.back-to-list model="ItemCategory"/>
@endsection

