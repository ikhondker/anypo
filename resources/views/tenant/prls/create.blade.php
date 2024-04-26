@extends('layouts.app')
@section('title','Add Requisition Line')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}">{{ $pr->id  }}</a></li>
	<li class="breadcrumb-item active">Add New Line</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Add Requisition Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions id="{{ $pr->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	{{-- @include('tenant.includes.pr.view-pr-header') --}}
	<x-tenant.widgets.pr.show-pr-header id="{{ $pr->id }}"/>

	<!-- form start -->
	<form action="{{ route('prls.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<!-- widget-pr-lines -->
		{{-- <x-tenant.widgets.pr.lines id="{{ $pr->id }}" :add="true"/> --}}
		<!-- /.widget-pr-lines -->

		<x-tenant.widgets.prl.show-pr-lines id="{{ $pr->id }}" :showAddMore="true">
			@include('tenant.includes.pr.pr-line-add')
			@include('tenant.includes.pr.pr-footer-form')
		</x-tenant.widgets.prl.show-pr-lines>

	</form>
	<!-- /.form end -->
	
	@include('tenant.includes.js.select2')
	@include('tenant.includes.js.calculate-pr-amount')
	
@endsection

