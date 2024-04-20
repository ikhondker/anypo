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
			
			<!-- Breadcrumb -->
			<div class="container">
				<div class="row align-items-lg-center pb-3">
					<div class="col-lg mb-2 mb-lg-0">
						<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir')  }}</h6>
					</div>
					<!-- End Col -->
					<div class="col-lg-auto">
						<x-landlord.table-links/>
					</div>
					<!-- End Col -->
					</div>
					<!-- End Row -->
			</div>
			<!-- End Breadcrumb -->

			@include('shared.includes.tables.tables')

		</div>
		<!-- /. card-body -->
	</div>
	<!-- End Card -->

@endsection


