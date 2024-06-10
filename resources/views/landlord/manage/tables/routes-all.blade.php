@extends('layouts.landlord.app')
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
			<!-- Breadcrumb -->
			<div class="container">
				<div class="row align-items-lg-center pb-3">
					<div class="col-lg mb-2 mb-lg-0">
						<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir')}}</h6>
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

			@include('shared.includes.tables.routes-all')

		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

@endsection

