@extends('layouts.app')
@section('title',' All Routes List')
@section('breadcrumb')
	All Routes List
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			All Routes List
		@endslot
		@slot('buttons')
			<x-tenant.table-links/>
		@endslot
	</x-tenant.page-header>

	 
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">All Routes</h5>
					<h6 class="card-subtitle text-muted">Route::getRoutes()->getRoutesByName();</h6>
				</div>
				<div class="card-body">
					
					@include('shared.includes.tables.routes-all')
					
				</div>
			</div>
		</div>
	</div>
	
@endsection

