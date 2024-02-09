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
					<h5 class="card-title">Routes Code</h5>
					<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_MODEL') }}</h6>
				</div>
				<div class="card-body">
					@foreach($filesInFolder as $row) 
						<div class="alert alert-primary" role="alert">
							<div class="alert-message">
								<!-- ========== INCLUDE ========== -->
								@include('shared.includes.tables.routes')
								<!-- ========== INCLUDE ========== -->
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

@endsection

