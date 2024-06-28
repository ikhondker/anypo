@extends('layouts.landlord.app')
@section('title','Entity')
@section('breadcrumb','View Entity')

@section('content')

<h1 class="h3 mb-3">View Entity</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('entities.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
						@if (auth()->user()->isSystem())
							<a class="btn btn-sm btn-danger text-white" href="{{ route('entities.edit', $entity->entity) }}"><i class="fas fa-edit"></i> Edit</a>
						@endif
					</div>
					<h5 class="card-title">View Entity</h5>
					<h6 class="card-subtitle text-muted">View Entity Detail.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-badge	value="{{ $entity->entity }}" label="Code"/>
								<x-landlord.show.my-text	value="{{ $entity->name }}" label="Name"/>
								<x-landlord.show.my-text	value="{{ $entity->model }}" label="Model"/>
								<x-landlord.show.my-text	value="{{ $entity->route }}" label="Route"/>
								<x-landlord.show.my-badge	value="{{ $entity->directory }}" label="Directory"/>
								<x-landlord.show.my-text	value="{{ $entity->parent_entity }}" label="Parent"/>
								<x-landlord.show.my-enable	value="{{ $entity->enable }}"/>
								<x-landlord.show.my-enable	value="{{ $entity->notification }}" label="Notification"/>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection
