@extends('layouts.landlord.app')
@section('title', 'Helpers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')

	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Helpers List (Common)</h5>
			<h6 class="card-subtitle text-muted">Hardcoded: \app\Helpers</h6>
		</div>
		<div class="card-body">
			<!-- Breadcrumb -->
			<div class="container">
				<div class="row align-items-lg-center pb-3">
					<div class="col-lg mb-2 mb-lg-0">
						<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}</h6>
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

			@include('shared.includes.tables.helpers')


		</div>
	</div>

@endsection
