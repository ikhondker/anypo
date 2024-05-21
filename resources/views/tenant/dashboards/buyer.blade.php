@extends('layouts.app')
@section('title','Dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Dashboard</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Dashboard [TODO - BUYER]
		@endslot
		@slot('buttons')
			<x-tenant.actions.dashboard-actions/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.landlord-notice-all-tenants/>
	<x-tenant.landlord-notice-one-tenant/>


	<x-tenant.dashboards.po-counts/>

	<x-tenant.widgets.pr.pr-lists-po-pending/>

    <x-tenant.widgets.po.po-lists/>

@endsection
