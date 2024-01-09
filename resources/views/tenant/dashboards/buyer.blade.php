@extends('layouts.app')

@section('title','Dashboards | anypo.com')
@section('content-header')
	<!-- Null -->
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Dashboard [TODO]
		@endslot
		@slot('buttons')
			{{-- <x-tenant.buttons.header.create object="User"/> --}}
		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.pr-counts/>
	
	<x-tenant.widgets.pr-lists-po-pending/>
	
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
				<h5 class="card-title">Last 5 PO TODO</h5>
				</div>
				<div class="card-body">

				</div>
			</div>
		</div>
	</div>




	

	

	
@endsection
