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

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				@if (auth()->user()->isSystem())
					<a class="btn btn-sm btn-danger text-white" href="{{ route('currencies.edit', $currency->currency ) }}"><i data-lucide="edit"></i> Edit</a>
				@endif
			</div>
			<h5 class="card-title">Currency Detail</h5>
			<h6 class="card-subtitle text-muted">Currency details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-code		value="{{ $currency->currency }}"/>
					<x-tenant.show.my-text		value="{{ $currency->name }}"/>
					<x-tenant.show.my-boolean	value="{{ $currency->enable }}"/>
					<x-tenant.show.my-boolean	value="{{ $currency->enable }}" label="Rate Available "/>
					<x-tenant.show.my-created-at value="{{ $currency->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $currency->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>
	<x-tenant.widgets.back-to-list model="Currency"/>
@endsection

