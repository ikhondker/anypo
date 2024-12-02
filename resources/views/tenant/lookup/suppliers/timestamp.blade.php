@extends('layouts.tenant.app')
@section('title','View Supplier')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}" class="text-muted">Suppliers</a></li>
	<li class="breadcrumb-item active">{{ $supplier->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Supplier
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.supplier-actions supplierId="{{ $supplier->id }}"/>
		@endslot
	</x-tenant.page-header>

<x-tenant.widgets.who-when model="Supplier" articleId="{{ $supplier->id  }}"/>

<x-tenant.widgets.back-to-list model="Supplier"/>

@endsection

