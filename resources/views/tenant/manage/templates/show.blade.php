@extends('layouts.tenant.app')
@section('title','View Template ')
@section('breadcrumb')
	<li class="breadcrumb-item active">View Templates v1.4 (3-JUL-24)</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Template
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Template"/>
			<a href="{{ route('templates.create') }}" class="btn btn-primary float-end me-2"><i class="fas fa-plus"></i> New Template</a>
			<a href="{{ route('templates.edit',$template->id) }}" class="btn btn-primary float-end me-2"><i class="fas fa-edit"></i> Edit Template</a>
			<a href="{{ route('templates.index') }}" class="btn btn-primary float-end me-2"><i class="fas fa-plus"></i> Template List</a>
		@endslot
	</x-tenant.page-header>

	<!-- ========== INCLUDE ========== -->
	@include('shared.includes.templates.show')
	<!-- ========== INCLUDE ========== -->


@endsection
