@extends('layouts.app')
@section('title','Policies List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')
 
	<x-tenant.page-header>
		@slot('title')
			Policies Lists
		@endslot
		@slot('buttons')
			<x-tenant.table-links/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					{{-- <h5 class="card-title">Policies Lists</h5>
					<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_MODEL') }}</h6> --}}
					<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir')  }}</h6><br>
					<a class="" href="{{ route('tables.policies') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
					<a class="" href="{{ route('tables.policies','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
					<a class="" href="{{ route('tables.policies','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
					<a class="" href="{{ route('tables.policies','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
					<a class="" href="{{ route('tables.policies','Workflow') }}"><i class="align-middle me-1" data-feather="folder"></i>Workflow</a>
					<a class="" href="{{ route('tables.policies','Support') }}"><i class="align-middle me-1" data-feather="folder"></i>Support</a>
				</div>
				<div class="card-body">
					<h5>App\Provider\AuthServiceProvider.php</h5>
					@foreach($filesInFolder as $row) 
						'App\policies\Tenant\{{ $dir }}\{{ $row['fname'] }}' => 'App\Policies\Tenant\{{ $dir }}\{{ $row['fname'] }}Policy',</br>
					@endforeach
				</div>
			</div>
		</div>
	</div>

@endsection

