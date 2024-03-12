@extends('layouts.landlord-app')
@section('title','Controllers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Controllers List</h5>
		</div>

		<!-- card-body -->
		<div class="card-body">

			<x-landlord.table-links/>

			@include('shared.includes.tables.controllers')

		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->


@endsection

