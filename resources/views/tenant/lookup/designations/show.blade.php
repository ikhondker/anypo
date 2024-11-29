@extends('layouts.tenant.app')
@section('title','View Designation')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('designations.index') }}" class="text-muted">Designations</a></li>
	<li class="breadcrumb-item active">{{ $designation->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Designation
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Designation"/>
			<x-tenant.actions.lookup.designation-actions designationId="{{ $designation->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a class="btn btn-sm btn-light" href="{{ route('designations.edit', $designation->id ) }}"><i class="fas fa-edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('designations.index') }}" ><i class="fas fa-list"></i> View all</a>
			</div>
			<h5 class="card-title">Designation Detail</h5>
			<h6 class="card-subtitle text-muted">Designation details.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $designation->name }}"/>
					<x-tenant.show.my-boolean	value="{{ $designation->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $designation->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $designation->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

