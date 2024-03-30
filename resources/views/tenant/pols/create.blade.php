@extends('layouts.app')
@section('title','Add PO Line')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Add PO Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions id="{{ $po->id }}" show="true"/>
		
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.widgets.po.show-po-header id="{{ $po->id }}"/>

	<!-- form start -->
	<form action="{{ route('pols.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<!-- widget-po-lines -->
		<x-tenant.widgets.pol.show-po-lines id="{{ $po->id }}">
			@include('tenant.includes.po.po-line-add')
			@include('tenant.includes.po.po-footer-form')
		</x-tenant.widgets.pol.show-po-lines>
		<!-- /.widget-po-lines -->

	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')

@endsection

