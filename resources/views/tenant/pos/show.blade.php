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
				<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			@endcan



			{{-- <a href="{{ route('invoices.create', $po->id) }}" class="btn btn-primary float-end me-2"><i data-lucide="plus"></i> Inv Create</a> --}}
			{{-- <x-tenant.buttons.header.edit object="Po" :id="$po->id"/> --}}
			{{-- <a href="{{ route('pols.createline', $po->id) }}" class="btn btn-primary float-end me-2"><i data-lucide="plus"></i> Add Line</a> --}}
			{{-- <a href="{{ route('pos.copy', $po->id) }}" class="btn btn-primary float-end me-2 sw2-advance"
				data-entity="" data-name="PO#{{ $po->id }}" data-status="Duplicate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate Order">
				<i data-lucide="printer"></i> Duplicate</a> --}}

			{{-- <a href="{{ route('payments.create-for-po', $po->id) }}" class="btn btn-primary float-end me-2"><i data-lucide="credit-card"></i> Payment</a> --}}
			{{-- <a href="{{ route('reports.po', $po->id) }}" class="btn btn-primary float-end me-2"><i data-lucide="printer"></i> Print</a> --}}
			@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)

			@endif

			<x-tenant.actions.po-actions poId="{{ $po->id }}"/>

		@endslot
	</x-tenant.page-header>

	@if ($po->auth_status == App\Enum\AuthStatusEnum::APPROVED->value)
		<x-tenant.dashboards.po-stats :id="$po->id"/>
	@endif

	<!-- approval form, show only if pending to current auth user -->
	@if ($po->auth_status == App\Enum\AuthStatusEnum::INPROCESS->value)
        @if (\App\Helpers\Tenant\Workflow::allowApprove($po->wf_id))
             <x-tenant.widgets.wfl.get-approval wfId="{{ $po->wf_id }}" />
        @endif
	@endif

 	<x-tenant.widgets.po.show-po-header poId="{{ $po->id }}"/>

	<x-tenant.widgets.pol.list-all-lines poId="{{ $po->id }}" :status="true" />

@endsection

