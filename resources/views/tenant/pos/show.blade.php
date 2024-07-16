@extends('layouts.tenant.app')
@section('title','View Purchase Order')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}">Purchase Orders</a></li>
	<li class="breadcrumb-item active">PO#{{ $po->id }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Order #{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>

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
				<a href="{{ route('pos.submit', $po->id) }}" class="btn btn-primary float-end me-2 sw2-advance"
					data-entity="" data-name="PO#{{ $po->id }}" data-status="Submit"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
					<i data-lucide="external-link"></i> Submit</a>
			@endif

			<x-tenant.actions.po-actions id="{{ $po->id }}"/>

		@endslot
	</x-tenant.page-header>


	<div class="row">

		<div class="col-12 col-sm-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body py-4">
					<div class="d-flex align-items-start">
						<div class="flex-grow-1">
							<h3 class="mb-2"> {{ number_format($po->fc_amount, 2, '.', ',') }} </h3>
							<p class="mb-2">PO Amount [{{ $_setup->currency }}]</p>
							<div class="mb-0">
								<span class="badge badge-subtle-success me-2"> {{ $po->currency }} </span>
								<span class="text-muted"> {{ number_format($po->amount, 2, '.', ',') }}</span>
							</div>
						</div>
						<div class="d-inline-block ms-3">
							<div class="stat">
								<i class="align-middle text-success" data-lucide="check-circle"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-sm-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body py-4">
					<div class="d-flex align-items-start">
						<div class="flex-grow-1">
							<h3 class="mb-2"> {{ number_format($po->fc_amount_grs, 2, '.', ',') }} </h3>
							<p class="mb-2">GRS Amount </p>
							<div class="mb-0">
								<span class="badge badge-subtle-success me-2">{{ $_setup->currency }} </span>
							</div>
						</div>
						<div class="d-inline-block ms-3">
							<div class="stat">
								<i class="align-middle text-success" data-lucide="check-circle"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-sm-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body py-4">
					<div class="d-flex align-items-start">
						<div class="flex-grow-1">
							<h3 class="mb-2"> {{ number_format($po->fc_amount_invoice, 2, '.', ',') }} </h3>
							<p class="mb-2">Invoice Amount </p>
							<div class="mb-0">
								<span class="badge badge-subtle-success me-2">{{ $_setup->currency }} </span>
							</div>
						</div>
						<div class="d-inline-block ms-3">
							<div class="stat">
								<i class="align-middle text-success" data-lucide="check-circle"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-sm-6 col-xxl-3 d-flex">
			<div class="card flex-fill">
				<div class="card-body py-4">
					<div class="d-flex align-items-start">
						<div class="flex-grow-1">
							<h3 class="mb-2"> {{ number_format($po->fc_amount_paid, 2, '.', ',') }} </h3>
							<p class="mb-2">Payment Amount </p>
							<div class="mb-0">
								<span class="badge badge-subtle-success me-2">{{ $_setup->currency }} </span>
							</div>
						</div>
						<div class="d-inline-block ms-3">
							<div class="stat">
								<i class="align-middle text-success" data-lucide="check-circle"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>



	<x-tenant.widgets.po.show-po-header id="{{ $po->id }}"/>


	<!-- widget-pol-card -->
	<x-tenant.widgets.pol.card :po="$po">
		@slot('lines')
			<tbody>
				@forelse ($pols as $pol)
					<x-tenant.widgets.pol.card-table-row :line="$pol" :status="$po->auth_status"/>
				@empty

				@endforelse
			</tbody>
		@endslot
	</x-tenant.widgets.pol.card>
	<!-- /.widget-pol-card -->


	<!-- approval form, show only if pending to current auth user -->
	@if (\App\Helpers\Tenant\Workflow::allowApprove($po->wf_id))
		{{-- @include('tenant.includes.wfl-approve-reject') --}}
		<x-tenant.widgets.wfl.get-approval wfid="{{ $po->wf_id }}" />
	@endif



@endsection

