@extends('layouts.landlord-app')
@section('title','Tables')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-title">Table List DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]</h5>
		</div>

		<!-- card-body -->
		<div class="card-body">
			<x-landlord.table-links/>

			@include('shared.includes.tables.tables')

		</div>
		<!-- /. card-body -->
	</div>
	<!-- End Card -->

@endsection


