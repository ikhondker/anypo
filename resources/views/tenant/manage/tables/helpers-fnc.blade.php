@extends('layouts.tenant.app')
@section('title', 'Controllers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Functions in Helpers
		@endslot
		@slot('buttons')
			<x-tenant.table-links />
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Functions in Helpers</h5>
					<h6 class="card-subtitle text-muted">Hardcoded: \app\Helpers</h6>
				</div>
				<div class="card-body">
					<!-- ========== INCLUDE ========== -->
					@include('shared.includes.tables.helpers-fnc')
					<!-- ========== INCLUDE ========== -->
				</div>
			</div>
		</div>
	</div>


@endsection
