@extends('layouts.tenant.app')
@section('title','My Purchase Orders')
@section('breadcrumb')
	<li class="breadcrumb-item active">Purchase Orders</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			My Purchase Orders
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions-index/>
		@endslot
	</x-tenant.page-header>

	@if (auth()->user()->isBuyer())
		<x-tenant.dashboards.po-counts-buyer/>
	@else
		<x-tenant.dashboards.po-counts/>
	@endif

	
	<div class="card">
		<div class="card-header">
			<x-tenant.cards.header-search-bar object="Po"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					My Purchase Orders
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of My Purchase Orders.</h6>
		</div>
		<div class="card-body">
			<!-- ========== INCLUDE ========== -->
			@include('tenant.includes.po.po-lists-table')
			<!-- ========== INCLUDE ========== -->
		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->


@endsection

