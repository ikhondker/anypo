@extends('layouts.app')
@section('title', 'Controllers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Functions in Controller
		@endslot
		@slot('buttons')
			<x-tenant.table-links />
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					{{-- <h5 class="card-title">Functions in Controller </h5>
					<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_CLASS') }}</h6> --}}
					<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}</h6><br>
					<a class="" href="{{ route('tables.fnc-controllers') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
					<a class="" href="{{ route('tables.fnc-controllers','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
					<a class="" href="{{ route('tables.fnc-controllers','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
					<a class="" href="{{ route('tables.fnc-controllers','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
					<a class="" href="{{ route('tables.fnc-controllers','Workflow') }}"><i class="align-middle me-1" data-feather="folder"></i>Workflow</a>
					<a class="" href="{{ route('tables.fnc-controllers','Support') }}"><i class="align-middle me-1" data-feather="folder"></i>Support</a>

				</div>
				<div class="card-body">
					
					<!-- ========== INCLUDE ========== -->
					@include('shared.includes.tables.controllers-fnc')
					<!-- ========== INCLUDE ========== -->
				</div>
			</div>
		</div>
	</div>


@endsection
