@extends('layouts.app')
@section('title','Test Component')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Test Component
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Item"/>
			<x-tenant.buttons.header.create object="Item"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Test Component</h5>
					<h6 class="card-subtitle text-muted"><h6 class="card-subtitle text-muted">Detail Information of Test Component.</h6>.</h6>
				</div>
				<div class="card-body">
					@php
						$type 			= 'error';
						$message2 		= 'Sample Message1';
						$dept_budget_id = '1099'
					@endphp
					{{-- <x-tenant.test-component/> --}}
					{{-- <x-tenant.test-component dept_budget_id="{{ $dept_budget_id }}"/> --}}
					{{-- <x-tenant.test-component :dept_budget_id="$dept_budget_id"/> --}}
					{{-- <x-tenant.test-component :type="$type" :message="$message"/> --}}
					<x-tenant.test-component/>
					<x-tenant.test-component :dbid="$dept_budget_id"/>
					{{-- <x-tenant.test-component :message="$message" :dept_budget_id="$dept_budget_id"/> --}}

				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

