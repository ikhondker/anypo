@extends('layouts.tenant.app')
@section('title','Header Comments')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Header Comments
		@endslot
		@slot('buttons')
			<x-tenant.table-links/>
		@endslot
	</x-tenant.page-header>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					{{-- <h5 class="card-title">Header Comments</h5>
					<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_CLASS') }}</h6> --}}
					<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}</h6><br>
					<a class="" href="{{ route('tables.comments') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
					<a class="" href="{{ route('tables.comments','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
					<a class="" href="{{ route('tables.comments','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
					<a class="" href="{{ route('tables.comments','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
					<a class="" href="{{ route('tables.comments','Workflow') }}"><i class="align-middle me-1" data-feather="folder"></i>Workflow</a>
					<a class="" href="{{ route('tables.comments','Support') }}"><i class="align-middle me-1" data-feather="folder"></i>Support</a>

				</div>
				<div class="card-body">
					@foreach($filesInFolder as $row) 
						<div class="alert alert-primary" role="alert">
							<div class="alert-message">
								<h5>{{ $row['bname'] }}</h5>
<!-- ========== INCLUDE ========== -->
@include('shared.includes.tables.comments')
<!-- ========== INCLUDE ========== -->
						</div>
					</div>

					@endforeach

				</div>
			</div>
		</div>
	</div>

@endsection

