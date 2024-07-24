@extends('layouts.tenant.app')
@section('title','View Item Group')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('groups.index') }}" class="text-muted">Item Groups</a></li>
	<li class="breadcrumb-item active">{{ $group->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Item Group
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.group-actions id="{{ $group->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('groups.edit', $group->id ) }}"><i class="fas fa-edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('groups.index') }}"><i class="fas fa-list"></i> View all</a>
			</div>
			<h5 class="card-title">Item Group Detail</h5>
			<h6 class="card-subtitle text-muted">Item Group details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $group->name }}"/>
					<x-tenant.show.my-boolean	value="{{ $group->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $group->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $group->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

