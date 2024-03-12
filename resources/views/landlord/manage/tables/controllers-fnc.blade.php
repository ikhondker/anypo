@extends('layouts.landlord-app')
@section('title', 'Controllers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Functions in Controller
		@endslot
		@slot('buttons')
			<x-tenant.table-links />
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Functions in Controller </h5>
					<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_CLASS') }}</h6>
				</div>
				<div class="card-body">
					<x-landlord.table-links/>
					
					<!-- ========== INCLUDE ========== -->
					@include('shared.includes.tables.controllers-fnc')
					<!-- ========== INCLUDE ========== -->
				</div>
			</div>
		</div>
	</div>


@endsection
