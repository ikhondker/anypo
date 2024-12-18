@extends('layouts.landlord.app')
@section('title','Routes Code')
@section('breadcrumb')
	<li class="breadcrumb-item active">{{ env('DB_DATABASE')}}@[{{ base_path()}}]</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Routes Code
		@endslot
		@slot('buttons')
		<x-share.actions.table-actions/>
		@endslot
	</x-tenant.page-header>

	<!-- ========== INCLUDE ========== -->
	@include('shared.includes.tables.routes-code')
	<!-- ========== INCLUDE ========== -->

@endsection

