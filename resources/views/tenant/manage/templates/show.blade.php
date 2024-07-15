@extends('layouts.tenant.app')
@section('title','View Template ')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('templates.index') }}">Templates</a></li>
	<li class="breadcrumb-item active">View Templates v1.5 (15-JUL-24)</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Template
		@endslot
		@slot('buttons')
			<x-share.actions.template-actions id="{{ $template->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- ========== INCLUDE ========== -->
	@include('shared.includes.templates.show')
	<!-- ========== INCLUDE ========== -->


@endsection
