@extends('layouts.landlord-app')
@section('title', 'Functions in Helpers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Functions in Helpers</h5>
					<h6 class="card-subtitle text-muted">Hardcoded: \app\Helpers</h6>
				</div>
				<div class="card-body">
					<x-landlord.table-links/>
					
					<!-- ========== INCLUDE ========== -->
					@include('shared.includes.tables.helpers-fnc')
					<!-- ========== INCLUDE ========== -->
				</div>
			</div>
		</div>
	</div>


@endsection
