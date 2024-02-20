@extends('layouts.app')
@section('title','Purchase Order Invoice')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Invoices for PO #{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions id="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.po-info id="{{ $po->id }}"/>

	{{-- @include('tenant.includes.pr.view-pr-header-basic') --}}

	<x-tenant.widgets.po.invoices :id="$po->id" />

	

@endsection

