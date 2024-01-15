@extends('layouts.app')
@section('title','Edit Purchase Order Line')

@section('content')

	<x-tenant.page-header>
		@slot('title')
		Edit Purchase Order Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po"/>
			<x-tenant.buttons.header.create object="Po"/>
			<x-tenant.buttons.header.edit object="Po" :id="$pr->id"/>
			<x-tenant.buttons.header.pdf object="Po" :id="$pr->id"/>
			<x-tenant.buttons.header.add-line object="Prl" :id="$pr->id"/>
		@endslot
	</x-tenant.page-header>
	
	@include('tenant.includes.po.view-po-header')

	<!-- form start -->
	<form action="{{ route('pols.update',$prl->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<!-- widget-po-lines -->
		<x-tenant.widgets.po-lines id="{{ $po->id }}" :edit="true" pid="{{ $pol->id }}"/>
		<!-- /.widget-pr-lines -->

	</form>
	<!-- /.form end -->

	<!-- Approval History -->
	@if ($pr->wf_id <> 0)
		<x-tenant.widgets.approval-history id="{{ $pr->wf_id }}"/>
	@endif
	

	<!-- approval form, show only if pending to current auth user -->
	{{-- @if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
	@include('tenant.includes.wfd-approve-reject')
	@endif  --}}

	  
@endsection

