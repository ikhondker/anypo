@extends('layouts.tenant.app')
@section('title','View Status')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('statuses.index') }}">Statuses</a></li>
	<li class="breadcrumb-item active">{{ $status->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Status
		@endslot
		@slot('buttons')
		<x-tenant.actions.manage.status-actions code="{{ $status->code }}"/>
			<x-tenant.buttons.header.lists object="Status"/>
			<x-tenant.buttons.header.create object="Status"/>
			<x-tenant.buttons.header.edit object="Status" :id="$status->code"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
			</div>
			<h5 class="card-title">Status Detail</h5>
			<h6 class="card-subtitle text-muted">Status details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-badge		value="{{ $status->code }}" label="Code"/>
					<x-tenant.show.my-text		value="{{ $status->name }}"/>
					<x-tenant.show.my-badge		value="{{ $status->badge }}" label="Badge"/>
					
					<x-tenant.show.my-boolean	value="{{ $status->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $status->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $status->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

	

@endsection

