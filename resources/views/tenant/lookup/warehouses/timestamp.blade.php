@extends('layouts.tenant.app')
@section('title','View Warehouse')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}" class="text-muted">Warehouses</a></li>
	<li class="breadcrumb-item active">{{ $warehouse->name }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Warehouse
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.warehouse-actions warehouseId="{{ $warehouse->id }}"/>
		@endslot
	</x-tenant.page-header>

    <x-tenant.widgets.who-when model="Warehouse" articleId="{{ $warehouse->id  }}"/>

    <x-tenant.widgets.back-to-list model="Warehouse"/>

@endsection

