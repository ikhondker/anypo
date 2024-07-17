@extends('layouts.tenant.app')
@section('title','View Menus')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>
	<li class="breadcrumb-item active">{{ $menu->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Menu
		@endslot
		@slot('buttons')
			<x-tenant.actions.manage.menu-actions id="{{ $menu->id }}"/>
		@endslot
	</x-tenant.page-header>


	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('menus.edit', $menu->id ) }}"><i class="fas fa-edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('menus.index') }}" ><i class="fas fa-list"></i> View all</a>
			</div>
			<h5 class="card-title">Menu Detail</h5>
					<h6 class="card-subtitle text-muted">Show Menu Details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-badge		value="{{ $menu->id }}" label="ID"/>
					<x-tenant.show.my-text		value="{{ $menu->raw_route_name }}" label="Raw Route Name"/>
					<x-tenant.show.my-text		value="{{ $menu->route_name }}" label="Route Name"/>
					<x-tenant.show.my-text		value="{{ $menu->node_name }}" label="Node Name"/>
					<x-tenant.show.my-boolean	value="{{ $menu->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $menu->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $menu->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>


@endsection

