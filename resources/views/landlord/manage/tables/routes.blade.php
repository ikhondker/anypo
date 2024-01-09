@extends('layouts.landlord-app')
@section('title','Routes List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')
	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Routes Lists</h5>
		</div>

		<!-- card-body -->
		<div class="card-body">
			<x-landlord.table-links/>

			@foreach($filesInFolder as $row)
				<div class="alert alert-secondary" role="alert">
					<!-- ========== INCLUDE ========== -->
					@include('shared.includes.tables.routes')
					<!-- ========== INCLUDE ========== -->
				</div>
			@endforeach
		</div>
	</div>
	<!-- End Card -->

@endsection

