@extends('layouts.tenant.app')
@section('title','Edit Template')
@section('breadcrumb')
	<li class="breadcrumb-item active">View Templates v1.4 (3-JUL-24)</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Template
		@endslot
		@slot('buttons')
			<button class="btn btn-primary me-1" type="submit" form="myform"><i class="fas fa-save"></i> Save</button>
			{{-- <input type="submit" form="myform" value="Update1" class="btn btn-primary float-end me-2"/> --}}
			<x-tenant.buttons.header.lists object="Template"/>
			<a href="{{ route('templates.create') }}" class="btn btn-primary float-end me-1"><i class="fas fa-plus"></i> Create Template</a>

		@endslot
	</x-tenant.page-header>

     <!-- ========== INCLUDE ========== -->
	@include('shared.includes.templates.edit')
	<!-- ========== INCLUDE ========== -->




@endsection

