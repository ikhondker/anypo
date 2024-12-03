@extends('layouts.tenant.app')
@section('title','Templates')
@section('breadcrumb')
	<li class="breadcrumb-item active">View Templates v1.4 (3-JUL-24)</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Templates Lists
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Template"/>
		@endslot
	</x-tenant.page-header>

	<!-- ========== INCLUDE ========== -->
	@include('shared.includes.templates.index')
	<!-- ========== INCLUDE ========== -->

@endsection

