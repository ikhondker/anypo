@extends('layouts.tenant.app')
@section('title','PO for a Supplier')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
	<li class="breadcrumb-item active">{{ $supplier->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			PO for a Supplier
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Supplier"/>
			<x-tenant.actions.supplier-actions id="{{ $supplier->id }}"/>
		@endslot
	</x-tenant.page-header>


	<x-tenant.info.supplier-info id="{{ $supplier->id }}"/>

	<x-tenant.widgets.po.list-by-supplier id="{{ $supplier->id }}"/>
	
	
@endsection

