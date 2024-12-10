@extends('layouts.tenant.app')
@section('title','View Status')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('statuses.index') }}" class="text-muted">Statuses</a></li>
	<li class="breadcrumb-item active">{{ $status->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Status
		@endslot
		@slot('buttons')
			<x-tenant.actions.manage.status-actions code="{{ $status->code }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('statuses.edit', $status->code ) }}"><i data-lucide="edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('statuses.index') }}" ><i data-lucide="database"></i> View all</a>
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

