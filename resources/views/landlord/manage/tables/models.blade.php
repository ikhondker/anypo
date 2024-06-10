@extends('layouts.landlord.app')
@section('title','Models List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Model Lists</h5>

		</div>

		<!-- card-body -->
		<div class="card-body">
			<!-- Breadcrumb -->
			<div class="container">
				<div class="row align-items-lg-center pb-3">
					<div class="col-lg mb-2 mb-lg-0">
						<a class="" href="{{ route('tables.models') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
						<a class="" href="{{ route('tables.models','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
						<a class="" href="{{ route('tables.models','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
						<a class="" href="{{ route('tables.models','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
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

			@include('shared.includes.tables.models')

		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

@endsection



