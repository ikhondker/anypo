@extends('layouts.app')
@section('title','Edit PR Line')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit PR Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
			<x-tenant.buttons.header.create object="Pr"/>
			<x-tenant.buttons.header.edit object="Pr" :id="$pr->id"/>
			<x-tenant.buttons.header.pdf object="Pr" :id="$pr->id"/>
			<x-tenant.buttons.header.add-line object="Prl" :id="$pr->id"/>
		@endslot
	</x-tenant.page-header>
	
	@include('tenant.includes.pr.view-pr-header')

	<!-- form start -->
	<form action="{{ route('prls.update',$prl->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<!-- widget-pr-lines -->
		<x-tenant.widgets.pr-lines id="{{ $pr->id }}" :edit="true" pid="{{ $prl->id }}"/>
		<!-- /.widget-pr-lines -->

	</form>
	<!-- /.form end -->

	<!-- Approval History -->
	@if ($pr->wf_id <> 0)
		<x-tenant.wf.approval-history id="{{ $pr->wf_id }}"/>
	@endif
	

	<!-- approval form, show only if pending to current auth user -->
	{{-- @if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
	@include('tenant.includes.wfd-approve-reject')
	@endif  --}}

	  
@endsection

