@extends('layouts.app')
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
					<h5 class="card-title">Header Comments</h5>
					<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_CLASS') }}</h6>
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

