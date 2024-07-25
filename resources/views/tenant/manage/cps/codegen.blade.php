@extends('layouts.tenant.app')
@section('title','Tenant Change Logs')
@section('breadcrumb')
	<li class="breadcrumb-item active">Tenant Change Logs</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
		Tenant Change Log
		@endslot
		@slot('buttons')
			
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Tenant Change Log</h5>
			<h6 class="card-subtitle text-muted">Tenant Version {{ $_setup->version }}</h6>
		</div>
		<div class="card-body">
			<h1>TBD</h1>
	</div>
	<!-- end card -->

@endsection

