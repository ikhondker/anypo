@extends('layouts.tenant.app')
@section('title','Edit Template')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('templates.index') }}">Templates</a></li>
	<li class="breadcrumb-item active">{{ $template->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Template
		@endslot
		@slot('buttons')
			<x-share.actions.template-actions id="{{ $template->id }}"/>
		@endslot
	</x-tenant.page-header>

	 <!-- ========== INCLUDE ========== -->
	@include('shared.includes.templates.edit')
	<!-- ========== INCLUDE ========== -->




@endsection

