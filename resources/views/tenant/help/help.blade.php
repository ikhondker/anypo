@extends('layouts.app')
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
		<a href="tel:{{ config('akk.SUPPORT_PHONE_NO')}}" class="btn btn-primary float-end me-2"><i data-feather="phone-outgoing"></i> Call support {{config('akk.SUPPORT_PHONE_NO')}}</a>
		<a  href="{{ route('tickets.create') }}" class="btn btn-primary float-end me-2"><i data-feather="message-square"></i> Create Ticket</a>
		<a href="{{ route('get-started') }}" class="btn btn-primary float-end me-2"><i data-feather="phone-outgoing"></i> Get Started **</a>
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
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpsetup" role="tab">Setups</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helppr" role="tab">Requisition</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helppo" role="tab">Purchase Orders</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpapproval" role="tab">Approval</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpcurrency" role="tab">Currency</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpbudget" role="tab">Budgets</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpdbudget" role="tab">Dept Budgets</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpmaster" role="tab">Master Data</a>
					<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#helpuser" role="tab">User Management</a>
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
				@include('tenant.help.includes.helpsetup')
				<!-- ========== INCLUDE ========== -->
				
				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helppr')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helppo')
				<!-- ========== INCLUDE ========== -->

				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpapproval')
				<!-- ========== INCLUDE ========== -->
			
				<!-- ========== INCLUDE ========== -->
				@include('tenant.help.includes.helpcurrency')
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
				@include('tenant.help.includes.helpsupport')
				<!-- ========== INCLUDE ========== -->


				

			</div>
			 <!-- end tab-content -->
		</div>
		
	</div>


@endsection

