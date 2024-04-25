@extends('layouts.app')

@section('title','Dashboards | anypo.com')
@section('content-header')
	<!-- Null -->
@endsection

@section('breadcrumb')
	<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Dashboard
		@endslot
		@slot('buttons')
			{{-- <x-tenant.buttons.header.create object="User"/> --}}
		@endslot
	</x-tenant.page-header>

	<x-tenant.landlord-notice-all-tenants/>
	<x-tenant.landlord-notice-one-tenant/>

	<x-tenant.dashboards.pr-counts/>
	
	<x-tenant.widgets.pr.pr-lists/>
	
@endsection
