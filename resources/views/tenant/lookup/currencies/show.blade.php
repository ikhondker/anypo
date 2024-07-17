@extends('layouts.tenant.app')
@section('title','View Currency')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('currencies.index') }}">Departments</a></li>
	<li class="breadcrumb-item active">{{ $currency->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Currency
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.currency-actions code="{{ $currency->currency }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('currencies.edit', $currency->currency ) }}"><i class="fas fa-edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('currencies.index') }}" ><i class="fas fa-list"></i> View all</a>
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
					<x-tenant.show.my-boolean	value="{{ $currency->enable }}" label="Rate Available?"/>
					<x-tenant.show.my-created-at value="{{ $currency->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $currency->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

