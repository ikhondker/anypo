@extends('layouts.app')
@section('title','View Purchase Requisition')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}">Requisitions</a></li>
	<li class="breadcrumb-item active">PR #{{ $pr->id  }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Requisition #{{ $pr->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr" label="Requisition"/>
			<x-tenant.buttons.header.create object="Pr" label="Requisition"/>
			
			<a href="{{ route('reports.pr', $pr->id) }}" class="btn btn-primary float-end me-2"><i data-feather="printer"></i> Print</a>
			@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
				<a href="{{ route('prs.submit', $pr->id) }}" class="btn btn-primary float-end me-2 sw2-advance"
					data-entity="" data-name="PR#{{ $pr->id }}" data-status="Submit"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Submit Requisition">
					<i data-feather="external-link"></i> Submit</a>
			@endif

			<x-tenant.actions.pr-actions id="{{ $pr->id }}"/>

		@endslot
	</x-tenant.page-header>
		
	<x-tenant.widgets.pr.show-pr-header id="{{ $pr->id }}"/>
	

	<!-- widget-pr-lines -->
	<x-tenant.widgets.prl.show-pr-lines id="{{ $pr->id }}">
		@include('tenant.includes.pr.pr-footer-show')
	</x-tenant.widgets.prl.show-pr-lines>
	{{-- <x-tenant.widgets.pr.lines id="{{ $pr->id }}" :show="true"/> --}}
	<!-- /.widget-pr-lines -->

	{{-- <x-tenant.widgets.wfl.get-approval wfid="{{ $pr->wf_id }}" /> --}}

	<!-- approval form, show only if pending to current auth user -->
	@if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
		{{-- @include('tenant.includes.wfl-approve-reject') --}}
		<x-tenant.widgets.wfl.get-approval wfid="{{ $pr->wf_id }}" />
	@endif
	
	@include('shared.includes.js.sw2-advance')
	  
@endsection

