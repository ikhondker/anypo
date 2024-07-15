@extends('layouts.landlord.app')
@section('title','Template')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('templates.index') }}">Templates</a></li>
	<li class="breadcrumb-item active">View Templates v1.5 (15-JUL-24)</li>
@endsection


@section('content')

	<div class="row mb-2 mb-xl-3">
		<div class="col-auto d-none d-sm-block">
			<h3 class="mb-3"><i class="align-middle text-muted" data-lucide="grid"></i> Template Info</h3>
		</div>

		<div class="col-auto ms-auto text-end mt-n1">
			<x-share.actions.template-actions id="{{ $template->id }}"/>
		</div>
	</div>


	<!-- ========== INCLUDE ========== -->
	@include('shared.includes.templates.show')
	<!-- ========== INCLUDE ========== -->

@endsection

