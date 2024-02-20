@extends('layouts.app')
@section('title','Edit Purchase Order Line')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Purchase Order Line
		@endslot
		@slot('buttons')

			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.pol-actions id="{{ $pol->id }}"/>
		
		@endslot
	</x-tenant.page-header>
	
	@include('tenant.includes.po.view-po-header')

	<!-- form start -->
	<form action="{{ route('pols.update',$pol->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<!-- widget-po-lines -->
		<x-tenant.widgets.po.lines id="{{ $po->id }}" :edit="true" pid="{{ $pol->id }}"/>
		<!-- /.widget-pr-lines -->

	</form>
	<!-- /.form end -->

	<!-- Approval History -->
	@if ($po->wf_id <> 0)
		<x-tenant.wf.approval-history id="{{ $po->wf_id }}"/>
	@endif
	

	<!-- approval form, show only if pending to current auth user -->
	{{-- @if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
	@include('tenant.includes.wfd-approve-reject')
	@endif  --}}

	  
@endsection

