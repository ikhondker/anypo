@extends('layouts.tenant.app')
@section('title','View Currency')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('currencies.index') }}" class="text-muted">Currencies</a></li>
	<li class="breadcrumb-item active">{{ $currency->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Currency
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.currency-actions currencyCode="{{ $currency->currency }}"/>
		@endslot
	</x-tenant.page-header>


	<x-tenant.widgets.who-when model="Currency" articleId="{{ $currency->currency; }}"/>

	<x-tenant.widgets.back-to-list model="Currency"/>
@endsection

