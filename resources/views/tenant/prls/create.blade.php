@extends('layouts.app')
@section('title','Add Requisition Line')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Add Requisition Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr" label="Requisition"/>
			<x-tenant.buttons.header.create object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions id="{{ $pr->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	@include('tenant.includes.pr.view-pr-header')

	<!-- form start -->
	<form action="{{ route('prls.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<!-- widget-pr-lines -->
		<x-tenant.widgets.pr.lines id="{{ $pr->id }}" :add="true"/>
		<!-- /.widget-pr-lines -->

	</form>
	<!-- /.form end -->

		
@endsection

