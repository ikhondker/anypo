@extends('layouts.tenant.app')
@section('title','Dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Dashboard</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Dashboard
		@endslot
		@slot('buttons')
			<x-tenant.actions.dashboard-actions/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.landlord-notice-all-tenants/>

	<x-tenant.landlord-notice-one-tenant/>

	<div class="row">
		<x-tenant.charts.budget-by-dept-pie/>
		<x-tenant.charts.budget-po-pie/>
		<x-tenant.charts.budget-by-dept-po-bar/>
	</div>

	<x-tenant.dashboards.budget-stat/>

	<x-tenant.dashboards.pr-counts/>


	<x-tenant.widgets.pr.pr-lists-recent/>


	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
				<h5 class="card-title">Empty card Test</h5>
				</div>
				<div class="card-body">

				</div>
			</div>
		</div>
	</div>










@endsection
