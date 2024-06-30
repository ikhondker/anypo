@extends('layouts.tenant.app')
@section('title','Tables')
@section('breadcrumb')
	<li class="breadcrumb-item active">{{ env('DB_DATABASE')}}@[{{ base_path()}}]</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Tables Lists
		@endslot
		@slot('buttons')
		<x-share.actions.table-actions/>
		@endslot
	</x-tenant.page-header>

	@include('shared.includes.tables.tables')

@endsection
