@extends('layouts.app')
@section('title', 'Controllers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Controllers Lists
		@endslot
		@slot('buttons')
			<x-tenant.table-links />
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Controllers List</h5>
					<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_CLASS') }}</h6>
				</div>
				<div class="card-body">
					
					@include('shared.includes.tables.controllers')

				</div>
			</div>
		</div>
	</div>


@endsection
