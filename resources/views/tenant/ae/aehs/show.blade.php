@extends('layouts.tenant.app')
@section('title','View Accounting')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('aehs.index') }}" class="text-muted">Accounting</a></li>
	<li class="breadcrumb-item active">AE#{{ $aeh->id }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Accounting
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Aeh"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.aeh-info aehId="{{ $aeh->id }}"/>

	<x-tenant.ael.ael-for-aeh aehId="{{ $aeh->id }}"/>


@endsection

