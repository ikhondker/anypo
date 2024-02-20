@extends('layouts.app')
@section('title','View Purchase Requisition')

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
				<a href="{{ route('prs.submit', $pr->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
					data-entity="" data-name="PR#{{ $pr->id }}" data-status="Submit"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Submit Requisition">
					<i data-feather="external-link"></i> Submit</a>
			@endif

			<x-tenant.actions.pr-actions id="{{ $pr->id }}"/>

		@endslot
	</x-tenant.page-header>
		

	@include('tenant.includes.pr.view-pr-header')

	<!-- widget-pr-lines -->
	<x-tenant.widgets.pr.lines id="{{ $pr->id }}" :show="true"/>
		
	<!-- /.widget-pr-lines -->

	<!-- approval form, show only if pending to current auth user -->
	@if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
		@include('tenant.includes.wfl-approve-reject')
	@endif 
	
	@include('tenant.includes.modal-boolean-advance')
	  
@endsection

