@extends('layouts.tenant.app')
@section('title','Purchase Orders')
@section('breadcrumb')
	<li class="breadcrumb-item active">Purchase Orders</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Orders
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions-index/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.po-counts/>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-bar object="Po"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Purchase Order Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Purchase Orders.</h6>
				</div>
				<div class="card-body">

					<!-- ========== INCLUDE ========== -->
					@include('tenant.includes.po.po-lists-table')
					<!-- ========== INCLUDE ========== -->

				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

@endsection

