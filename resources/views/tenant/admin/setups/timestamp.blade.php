@extends('layouts.tenant.app')
@section('title','View Setup')
@section('breadcrumb')
	{{-- <li class="breadcrumb-item"><a href="{{ route('setups.index') }}">Setup</a></li> --}}
	<li class="breadcrumb-item active">{{ $setup->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Setup
		@endslot
		@slot('buttons')
			<x-tenant.actions.admin.setup-actions setupId="{{ $setup->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.who-when model="Setup" articleId="{{ $setup->id }}"/>

@endsection

