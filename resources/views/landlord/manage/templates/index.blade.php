@extends('layouts.landlord.app')
@section('title','Templates')
@section('breadcrumb')
	<li class="breadcrumb-item active">View Templates v1.4 (3-JUL-24)</li>
@endsection

@section('content')


	<a href="{{ route('templates.create') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="plus"></i> New Template</a>
	<h1 class="h3 mb-3">All Templates [ Disable does not work!?]</h1>

	<!-- ========== INCLUDE ========== -->
	@include('shared.includes.templates.index')
	<!-- ========== INCLUDE ========== -->


@endsection

