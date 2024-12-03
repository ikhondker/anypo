@extends('layouts.tenant.app')
@section('title','View Purchase Order')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item active">PO#{{ $po->id }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Order #{{ $po->id }}
		@endslot
		@slot('buttons')
			<a href="{{ route('pos.index') }}" class="btn btn-primary float-end me-2"><i data-lucide="list"></i> View All</a>
			@can('create', $po)
				<x-tenant.buttons.header.create model="Po" label="Purchase Order"/>
			@endcan

			<x-tenant.actions.po-actions poId="{{ $po->id }}"/>

		@endslot
	</x-tenant.page-header>

	@if ($po->auth_status == App\Enum\Tenant\AuthStatusEnum::APPROVED->value)
		<x-tenant.dashboards.po-stats :id="$po->id"/>
	@endif

	<!-- approval form, show only if pending to current auth user -->
	@if ($po->auth_status == App\Enum\Tenant\AuthStatusEnum::INPROCESS->value)
		@if (\App\Helpers\Tenant\Workflow::allowApprove($po->wf_id))
			 <x-tenant.widgets.wfl.get-approval wfId="{{ $po->wf_id }}" />
		@endif
	@endif

 	<x-tenant.widgets.po.show-po-header poId="{{ $po->id }}"/>


	<x-tenant.widgets.pol.list-all-lines poId="{{ $po->id }}" :status="true" />

@endsection

