@extends('layouts.landlord-app')
@section('title','Policies List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')
	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Policies Lists</h5>
		</div>

		<!-- card-body -->
		<div class="card-body">
			<x-landlord.table-links/>
			<h5>App\Provider\AuthServiceProvider.php</h5>
			@foreach($filesInFolder as $row) 
				'App\Models\Landlord\{{ $row['fname'] }}' => 'App\Policies\Landlord\{{ $row['fname'] }}Policy',</br>
			@endforeach
		</div>
		<!-- /. card-body -->
	</div>
	<!-- End Card -->
@endsection

