@extends('layouts.tenant.app')
@section('title','Header Comments')
@section('breadcrumb')
	<li class="breadcrumb-item active">{{ env('DB_DATABASE')}}@[{{ base_path()}}]</li>
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Header Comments
		@endslot
		@slot('buttons')
			<x-share.actions.table-actions/>
		@endslot
	</x-tenant.page-header>

<!-- ========== INCLUDE ========== -->
@include('shared.includes.tables.comments')
<!-- ========== INCLUDE ========== -->
	
@endsection

