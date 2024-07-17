@extends('layouts.tenant.app')
@section('title','View Purchase Requisition')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}" class="text-muted">Requisitions</a></li>
	<li class="breadcrumb-item active">PR#{{ $pr->id }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Requisition #{{ $pr->id }}
		@endslot
		@slot('buttons')
			
			<a href="{{ route('reports.pr', $pr->id) }}" class="btn btn-primary float-end me-2"><i data-lucide="printer"></i> Print</a>
			@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
				<a href="{{ route('prs.submit', $pr->id) }}" class="btn btn-primary float-end me-2 sw2-advance"
					data-entity="" data-name="PR#{{ $pr->id }}" data-status="Submit"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Submit Requisition">
					<i data-lucide="external-link"></i> Submit</a>
			@endif
			<x-tenant.actions.pr-actions id="{{ $pr->id }}"/>
		@endslot
	</x-tenant.page-header>
		
	<x-tenant.widgets.pr.show-pr-header id="{{ $pr->id }}"/>
	

	<!-- widget-prl-cards -->
	<x-tenant.widgets.prl.card :pr="$pr">
		@slot('lines')
			<tbody>
				@forelse ($prls as $prl)
					<x-tenant.widgets.prl.card-table-row :line="$prl" :status="$pr->auth_status"/>
				@empty

				@endforelse
			</tbody>
		@endslot
	</x-tenant.widgets.prl.card>
	<!-- /.widget-prl-cards -->

	<!-- approval form, show only if pending to current auth user -->
	@if ($pr->auth_status == App\Enum\AuthStatusEnum::INPROCESS->value)
		@if (\App\Helpers\Tenant\Workflow::allowApprove($pr->wf_id))
			{{-- @include('tenant.includes.wfl-approve-reject') --}}
			<x-tenant.widgets.wfl.get-approval wfid="{{ $pr->wf_id }}" />
		@endif
	@endif
	
	
	
@endsection

