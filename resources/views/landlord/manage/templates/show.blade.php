@extends('layouts.landlord.app')
@section('title','Template')
@section('breadcrumb')
	<li class="breadcrumb-item active">View Templates v1.4 (3-JUL-24)</li>
@endsection

@section('content')

    <h1 class="h3 mb-3">Template Info</h1>

	<!-- ========== INCLUDE ========== -->
	@include('shared.includes.templates.show')
	<!-- ========== INCLUDE ========== -->

@endsection

