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
			<x-tenant.actions.pol-actions id="{{ $po->id }}" show="true"/>
		
		@endslot
	</x-tenant.page-header>
	
	@include('tenant.includes.po.view-po-header')

	<!-- form start -->
	<form action="{{ route('pols.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<!-- widget-pr-lines -->
		<x-tenant.widgets.po.lines id="{{ $po->id }}" :add="true"/>
		<!-- /.widget-pr-lines -->

	</form>
	<!-- /.form end -->
		
@endsection

