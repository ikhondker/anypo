@extends('layouts.landlord-app')
@section('title', 'Helpers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Helpers List (Common)</h5>
					<h6 class="card-subtitle text-muted">Hardcoded: \app\Helpers</h6>
				</div>
				<div class="card-body">
					<x-landlord.table-links/>
					
					@include('shared.includes.tables.helpers')

					
				</div>
			</div>
		</div>
	</div>


@endsection
