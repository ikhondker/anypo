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
			<x-tenant.buttons.header.create model="Pr" label="Requisition"/>
			<a href="{{ route('prs.index') }}" class="btn btn-primary me-2"><i data-lucide="database"></i> View All</a>
			<x-tenant.actions.pr-actions prId="{{ $pr->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- approval form, show only if pending to current auth user -->
	@if ($pr->auth_status == App\Enum\Tenant\AuthStatusEnum::INPROCESS->value)
		@if (\App\Helpers\Tenant\Workflow::allowApprove($pr->wf_id))
			<x-tenant.widgets.wfl.get-approval wfId="{{ $pr->wf_id }}" />
		@endif
	@endif

	<x-tenant.widgets.pr.show-pr-header prId="{{ $pr->id }}"/>

	<x-tenant.widgets.prl.list-all-lines prId="{{ $pr->id }}"/>

@endsection

