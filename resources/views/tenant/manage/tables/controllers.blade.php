@extends('layouts.tenant.app')
@section('title', 'Controllers List')
@section('breadcrumb')
	<li class="breadcrumb-item active">{{ env('DB_DATABASE')}}@[{{ base_path()}}]</li>
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Controllers Lists
		@endslot
		@slot('buttons')
			<x-share.actions.table-actions/>
		@endslot
	</x-tenant.page-header>

	<!-- ========== INCLUDE ========== -->
	@include('shared.includes.tables.controllers')
	<!-- ========== INCLUDE ========== -->

@endsection
