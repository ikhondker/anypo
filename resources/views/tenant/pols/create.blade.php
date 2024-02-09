@extends('layouts.app')
@section('title','Add PO Line')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Add PO Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po"/>
			<x-tenant.buttons.header.edit object="Po" :id="$po->id"/>
			<a href="{{ route('pos.show', $po->id) }}" class="btn btn-primary float-end me-2"><i class="fas fa-plus"></i> View PO</a>
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

