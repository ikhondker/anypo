@extends('layouts.tenant.app')
@section('title','Table Structure')
@section('breadcrumb')
	
	<li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Tables</a></li>
	<li class="breadcrumb-item active"><strong>{{ $table }}</strong> </li>

@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Table: [{{ $table }}]
		@endslot
		@slot('buttons')
			<x-share.actions.table-actions/>
		@endslot
	</x-tenant.page-header>

	<!-- ========== INCLUDE ========== -->
	@include('shared.includes.tables.structures')
	<!-- ========== INCLUDE ========== -->

	
@endsection

