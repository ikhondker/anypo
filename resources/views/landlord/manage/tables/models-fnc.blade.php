@extends('layouts.landlord.app')
@section('title', 'Functions in Models')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Functions in Models
		@endslot
		@slot('buttons')
		<x-share.actions.table-actions/>
		@endslot
	</x-tenant.page-header>


	<!-- ========== INCLUDE ========== -->
	@include('shared.includes.tables.models-fnc')
	<!-- ========== INCLUDE ========== -->

@endsection
