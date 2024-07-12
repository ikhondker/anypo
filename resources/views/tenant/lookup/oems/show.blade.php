@extends('layouts.tenant.app')
@section('title','View OEM')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('depts.index') }}">Departments</a></li>
	<li class="breadcrumb-item active">{{ $oem->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View OEM
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Oem"/>
			<x-tenant.actions.lookup.oem-actions id="{{ $oem->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('oems.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
			</div>
			<h5 class="card-title">OEM Detail</h5>
			<h6 class="card-subtitle text-muted">OEM details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $oem->name }}"/>
					<x-tenant.show.my-boolean	value="{{ $oem->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $oem->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $oem->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

