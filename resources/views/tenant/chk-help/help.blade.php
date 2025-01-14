@extends('layouts.tenant.app')
@section('title','Documentation')
@section('breadcrumb')
	<li class="breadcrumb-item active">Documentation</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Documentation
		@endslot
		@slot('buttons')
			@if ( auth()->user()->role == UserRoleEnum::SYSTEM->value)
				<a href="tel:{{ config('akk.SUPPORT_PHONE_NO')}}" class="btn btn-danger float-end me-2"><i data-lucide="phone-outgoing"></i> Call support {{ config('akk.SUPPORT_PHONE_NO') }}</a>
				<a href="{{ route('get-started') }}" class="btn btn-danger float-end me-1"><i data-lucide="phone-outgoing"></i> Get Started **</a>
			@endif
			<a href="{{ route('tickets.create') }}" class="btn btn-primary float-end me-1"><i data-lucide="plus"></i> Create Ticket</a>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<div class="col-md-3 col-xl-2">

			<div class="card">
				<div class="card-header">
					<h5 class="card-title mb-0 text-primary">Contents</h5>
				</div>
				<div class="list-group list-group-flush" role="tablist">
					<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#helpstart" role="tab">Getting Started</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpfaq" role="tab">FAQ</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helppr" role="tab">Requisition</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helppo" role="tab">Purchase Orders</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpgrs" role="tab">Receipts</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpinv" role="tab">Invoice</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helppay" role="tab">Payment</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpbudget" role="tab">Budgets</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpdbudget" role="tab">Dept Budgets</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpmaster" role="tab">Master Data</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpuser" role="tab">User Management</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helphier" role="tab">Hierarchy</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpapproval" role="tab">Approval</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpwf" role="tab">Workflow</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpinterface" role="tab">Interface</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpcurrency" role="tab">Currency</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpsetup" role="tab">Setup</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpsupport" role="tab">Support</a>
				</div>
			</div>
		</div>

		<div class="col-md-9 col-xl-10">
			<div class="tab-content">

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpstart')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpfaq')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helppr')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helppo')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpgrs')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpinv')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helppay')
				<!-- ========== INCLUDE ========== -->


				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpbudget')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpdbudget')
				<!-- ========== INCLUDE ========== -->


				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpmaster')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpuser')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helphier')
				<!-- ========== INCLUDE ========== -->


				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpapproval')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpwf')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpinterface')
				<!-- ========== INCLUDE ========== -->


				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpcurrency')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpsetup')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpsupport')
				<!-- ========== INCLUDE ========== -->




			</div>
			 <!-- end tab-content -->
		</div>

	</div>


@endsection

