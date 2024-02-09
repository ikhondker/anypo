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
					<h5 class="card-title">Policies Lists</h5>
					<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_MODEL') }}</h6>
				</div>
				<div class="card-body">
					<h5>App\Provider\AuthServiceProvider.php</h5>
					@foreach($filesInFolder as $row) 
						'App\Models\Tenant\{{ $row['fname'] }}' => 'App\Policies\Tenant\{{ $row['fname'] }}Policy',</br>
					@endforeach
				</div>
			</div>
		</div>
	</div>

@endsection

