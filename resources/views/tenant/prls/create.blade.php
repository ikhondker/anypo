@extends('layouts.app')
@section('title','Add PR Line')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Add PR Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
			<x-tenant.buttons.header.edit object="Pr" :id="$pr->id"/>
			<a href="{{ route('prs.show', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fas fa-plus"></i> View Pr</a>
		@endslot
	</x-tenant.page-header>
	
	@include('tenant.includes.pr.view-pr-header')

	<!-- form start -->
	<form action="{{ route('prls.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

	<!-- widget-pr-lines -->
	<x-tenant.widgets.pr-lines id="{{ $pr->id }}" :add="true"/>
	<!-- /.widget-pr-lines -->

	</form>
	<!-- /.form end -->

		
@endsection

