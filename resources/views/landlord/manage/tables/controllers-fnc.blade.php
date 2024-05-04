@extends('layouts.landlord-app')
@section('title', 'Controllers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Functions in Controller </h5>
			<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_CLASS') }}</h6>
		</div>
		<div class="card-body">

			<!-- Breadcrumb -->
			<div class="container">
				<div class="row align-items-lg-center pb-3">
					<div class="col-lg mb-2 mb-lg-0">
						<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}</h6>
						<a class="" href="{{ route('tables.fnc-controllers') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
						<a class="" href="{{ route('tables.fnc-controllers','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
						<a class="" href="{{ route('tables.fnc-controllers','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
						<a class="" href="{{ route('tables.fnc-controllers','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
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
			
			<!-- ========== INCLUDE ========== -->
			@include('shared.includes.tables.controllers-fnc')
			<!-- ========== INCLUDE ========== -->
		</div>
	</div>

@endsection
