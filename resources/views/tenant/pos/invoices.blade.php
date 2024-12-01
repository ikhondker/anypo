@extends('layouts.tenant.app')
@section('title','Purchase Order Invoices')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}" class="text-muted">PO#{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Invoices</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Invoices for PO #{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<a href="{{ route('invoices.create-for-po', $po->id) }}" class="btn btn-primary float-end me-2">
				<i data-lucide="plus"></i> Create
			</a>

			<x-tenant.actions.po-actions poId="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.po-info poId="{{ $po->id }}"/>

	{{-- @include('tenant.includes.pr.view-pr-header-basic') --}}

	<x-tenant.widgets.po.invoices poId="{{ $po->id }}" />

@endsection

