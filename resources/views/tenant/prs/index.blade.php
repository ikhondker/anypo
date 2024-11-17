@extends('layouts.tenant.app')
@section('title','Purchase Requisitions')
@section('breadcrumb')
	<li class="breadcrumb-item active">Requisitions</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Requisitions
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions-index/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.pr-counts/>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.card.header-search-bar object="Pr"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Requisition Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Purchase Requisitions.</h6>
				</div>
				<div class="card-body">
				    <!-- ========== INCLUDE ========== -->
					@include('tenant.includes.pr.pr-lists-table')
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

