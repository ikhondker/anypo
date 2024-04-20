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
			<!-- Breadcrumb -->
			<div class="container">
				<div class="row align-items-lg-center pb-3">
					<div class="col-lg mb-2 mb-lg-0">
						<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir')  }}</h6>
						<a class="" href="{{ route('tables.policies') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
						<a class="" href="{{ route('tables.policies','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
						<a class="" href="{{ route('tables.policies','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
						<a class="" href="{{ route('tables.policies','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
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

			<h5>App\Provider\AuthServiceProvider.php</h5>
			@foreach($filesInFolder as $row) 
				'App\Models\Landlord\{{ $row['fname'] }}' => 'App\Policies\Landlord\{{ $row['fname'] }}Policy',</br>
			@endforeach
		</div>
		<!-- /. card-body -->
	</div>
	<!-- End Card -->
@endsection

