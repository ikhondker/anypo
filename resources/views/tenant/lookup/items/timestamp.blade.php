@extends('layouts.tenant.app')
@section('title','View Item')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('items.index') }}" class="text-muted">Items</a></li>
	<li class="breadcrumb-item active">{{ $item->code }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Item
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.item-actions itemId="{{ $item->id }}"/>
		@endslot
	</x-tenant.page-header>

<x-tenant.widgets.who-when model="Item" articleId="{{ $item->id  }}"/>

<x-tenant.widgets.back-to-list model="Item"/>
@endsection

