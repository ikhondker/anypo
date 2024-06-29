@extends('layouts.tenant.app')
@section('title','Tables')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Tables Lists
		@endslot
		@slot('buttons')
			<x-tenant.table-links/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">
			<div class="card">
				<div class="card-header">
				<h5 class="card-title">Tables Lists</h5>
				<h6 class="card-subtitle text-muted">DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]</h6>
				</div>
				<div class="card-body">
					@include('shared.includes.tables.tables')
				</div>
			</div>
		</div>
	</div>
@endsection
