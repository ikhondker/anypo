@extends('layouts.tenant.app')
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
		<x-share.actions.table-actions/>
		@endslot
	</x-tenant.page-header>


	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
			</div>
			<h5 class="card-title">Folder: {{ request()->route()->parameter('dir') }}</h5>
				<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}
					<a class="" href="{{ route('tables.policies') }}"><i class="align-middle me-1" data-lucide="folder"></i>Root</a>
					<a class="" href="{{ route('tables.policies','Admin') }}"><i class="align-middle me-1" data-lucide="folder"></i>Admin</a>
					<a class="" href="{{ route('tables.policies','Lookup') }}"><i class="align-middle me-1" data-lucide="folder"></i>Lookup</a>
					<a class="" href="{{ route('tables.policies','Manage') }}"><i class="align-middle me-1" data-lucide="folder"></i>Manage</a>
					<a class="" href="{{ route('tables.policies','Workflow') }}"><i class="align-middle me-1" data-lucide="folder"></i>Workflow</a>
					<a class="" href="{{ route('tables.policies','Support') }}"><i class="align-middle me-1" data-lucide="folder"></i>Support</a>
				</h6>
		</div>
		<div class="card-body">
			<h5>App\Provider\AuthServiceProvider.php</h5>
			@foreach($filesInFolder as $row)
				'App\policies\Tenant\{{ $dir }}\{{ $row['fname'] }}' => 'App\Policies\Tenant\{{ $dir }}\{{ $row['fname'] }}Policy',</br>
			@endforeach
		</div>
	</div>


@endsection

