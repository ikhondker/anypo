@extends('layouts.landlord.app')
@section('title','Menu')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('menus.index') }}" class="text-muted">Menus</a></li>
	<li class="breadcrumb-item active">{{ $menu->raw_route_name }}</li>
@endsection


@section('content')

<h1 class="h3 mb-3">View Menu</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('menus.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
						@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('menus.edit', $menu->id) }}"><i class="fas fa-edit"></i> Edit</a>

						@endif
					</div>
					<h5 class="card-title">View Menu</h5>
					<h6 class="card-subtitle text-muted">View Menu Detail.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-text	value="{{ $menu->raw_route_name }}" label="Raw Route Name"/>
								<x-landlord.show.my-text	value="{{ $menu->raw_route_name }}" label="Route Name"/>
								<x-landlord.show.my-text	value="{{ $menu->access }}" label="Access"/>
		
								<x-landlord.show.my-enable	value="{{ $menu->enable }}"/>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


@endsection

