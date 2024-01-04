@extends('layouts.landlord-app')
@section('title','Header Comments')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')


	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Header Comments</h5>
		</div>

		<!-- card-body -->
		<div class="card-body">
			<x-landlord.table-links/>

			@foreach($filesInFolder as $row)
				<h5>{{ $row['bname'] }}</h5>
				<div class="alert alert-primary" role="alert">
<!-- ========== INCLUDE ========== -->
@include('shared.includes.tables.comments')
<!-- ========== INCLUDE ========== -->
				</div>
			@endforeach
		</div>
	</div>
	<!-- End Card -->

@endsection

