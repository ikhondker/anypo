@extends('layouts.tenant.doc')
@section('title','Documentations')

@section('breadcrumb')
	<li class="breadcrumb-item active">Documentations</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Department Lists
		@endslot
		@slot('buttons')

		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-info">{{ request('term') }}</strong>
				@else
					Department Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of departments with Requisition and Purchase Order Approval Hierarchy</h6>
		</div>
		<div class="card-body">


		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

