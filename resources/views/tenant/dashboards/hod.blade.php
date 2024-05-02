@extends('layouts.app')

@section('title','Dashboards | anypo.com')
@section('content-header')
	<!-- Null -->
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

	@if ( \App\Helpers\Akk::userAnyDeptBudgetExists() )
		<div class="row">
			<x-tenant.charts.dept-budget-po-pie/>
			<x-tenant.charts.dept-budget-pr-pie/>
			<x-tenant.charts.dept-budget-bar/>
		</div>
	
		<x-tenant.dashboards.dept-budget-stat/>
	@endif 

	{{-- <x-tenant.dashboards.dept-budget-stat id="{{ auth()->user()->dept_id }}" /> --}}
	
	
	<x-tenant.dashboards.pr-counts/>
	
	<x-tenant.widgets.pr.pr-lists/>
	
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
