@extends('layouts.tenant.app')
@section('title','View OEM')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('oems.index') }}" class="text-muted">OEMs</a></li>
	<li class="breadcrumb-item active">{{ $oem->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View OEM
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.oem-actions oemId="{{ $oem->id }}"/>
		@endslot
	</x-tenant.page-header>

<x-tenant.widgets.who-when model="Oem" articleId="{{ $oem->id  }}"/>

<x-tenant.widgets.back-to-list model="Oem"/>

@endsection

