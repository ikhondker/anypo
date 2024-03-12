@extends('layouts.landlord-app')
@section('title',' All Routes List')
@section('breadcrumb')
	All Routes List
@endsection


@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">All Routes</h5>
		</div>

		<!-- card-body -->
		<div class="card-body">
			<x-landlord.table-links/>

			@include('shared.includes.tables.routes-all')
			
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->
	
@endsection

