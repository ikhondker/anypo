@extends('layouts.tenant.app')
@section('title','View Country')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('countries.index') }}" class="text-muted">Countries</a></li>
	<li class="breadcrumb-item active">{{ $country->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Country
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.country-actions countryCode="{{ $country->country }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('countries.edit', $country->country) }}"><i data-lucide="edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('countries.index') }}"><i data-lucide="database"></i> View all</a>
			</div>
			<h5 class="card-title">Country Detail</h5>
			<h6 class="card-subtitle text-muted">Country details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-code		value="{{ $country->country }}"/>
					<x-tenant.show.my-text		value="{{ $country->name }}"/>
					<x-tenant.show.my-boolean	value="{{ $country->enable }}"/>
					<x-tenant.show.my-boolean	value="{{ $country->enable }}" label="Rate Available?"/>
					<x-tenant.show.my-created-at value="{{ $country->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $country->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

