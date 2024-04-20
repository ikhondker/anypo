@extends('layouts.app')
@section('title', 'Models List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Model Lists
		@endslot
		@slot('buttons')
			<x-tenant.table-links />
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					{{-- <h5 class="card-title"> Model Lists</h5>
					<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_MODEL') }}</h6> --}}
					<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir')  }}</h6><br>
					<a class="" href="{{ route('tables.models') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
					<a class="" href="{{ route('tables.models','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
					<a class="" href="{{ route('tables.models','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
					<a class="" href="{{ route('tables.models','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
					<a class="" href="{{ route('tables.models','Workflow') }}"><i class="align-middle me-1" data-feather="folder"></i>Workflow</a>
					<a class="" href="{{ route('tables.models','Support') }}"><i class="align-middle me-1" data-feather="folder"></i>Support</a>

				</div>
				<div class="card-body">
					@include('shared.includes.tables.models')
				</div>
			</div>
		</div>
	</div>


@endsection
