@extends('layouts.app')
@section('title','Routes List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Routes Code
		@endslot
		@slot('buttons')
			<x-tenant.table-links/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					{{-- <h5 class="card-title">Routes Code: </h5> --}}
					<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}</h6><br>
					<a class="" href="{{ route('tables.route-code') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
					<a class="" href="{{ route('tables.route-code','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
					<a class="" href="{{ route('tables.route-code','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
					<a class="" href="{{ route('tables.route-code','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
					<a class="" href="{{ route('tables.route-code','Workflow') }}"><i class="align-middle me-1" data-feather="folder"></i>Workflow</a>
					<a class="" href="{{ route('tables.route-code','Support') }}"><i class="align-middle me-1" data-feather="folder"></i>Support</a>
				</div>
				<div class="card-body">
					@foreach($filesInFolder as $row) 
						<div class="alert alert-primary" role="alert">
							<div class="alert-message">
								<!-- ========== INCLUDE ========== -->
								@include('shared.includes.tables.routes-code')
								<!-- ========== INCLUDE ========== -->
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

@endsection

