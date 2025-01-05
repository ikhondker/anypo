@extends('layouts.tenant.app')
@section('title','Purchase Order Payments')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}" class="text-muted">PO#{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Payments</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Payments for PO #{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create model="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions poId="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.po-info poId="{{ $po->id }}"/>

	{{-- @include('tenant.includes.pr.view-pr-header-basic') --}}

	<x-tenant.widgets.po.payments poId="{{ $po->id }}"/>

@endsection

