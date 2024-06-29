@extends('layouts.tenant.app')
@section('title', 'Controllers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Controllers Lists
		@endslot
		@slot('buttons')
			<x-tenant.table-links />
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					{{-- <h5 class="card-title">Controllers List</h5> --}}
					{{-- <h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_CLASS') }}</h6> --}}
					<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}</h6><br>
					<a class="" href="{{ route('tables.controllers') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
					<a class="" href="{{ route('tables.controllers','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
					<a class="" href="{{ route('tables.controllers','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
					<a class="" href="{{ route('tables.controllers','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
					<a class="" href="{{ route('tables.controllers','Workflow') }}"><i class="align-middle me-1" data-feather="folder"></i>Workflow</a>
					<a class="" href="{{ route('tables.controllers','Support') }}"><i class="align-middle me-1" data-feather="folder"></i>Support</a>
				</div>
				<div class="card-body">
					
					@include('shared.includes.tables.controllers')

				</div>
			</div>
		</div>
	</div>


@endsection
