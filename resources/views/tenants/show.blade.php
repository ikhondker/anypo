@extends('layouts.landlord.app')
@section('title','Tenant Detail')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tenants.index') }}" class="text-muted">Tenants</a></li>
	<li class="breadcrumb-item active">{{ $tenant->id }}</li>
@endsection

@section('content')

	<a href="{{ route('tenants.index') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="database"></i> View all</a>

	<h1 class="h3 mb-3">View Tenant</h1>

			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('tenants.index') }}" class="btn btn-sm btn-light"><i data-lucide="edit"></i> View all</a>
						@if (auth()->user()->isSystem())
						<a class="btn btn-sm btn-danger text-white" href="{{ route('tenants.edit', $tenant->id) }}"><i data-lucide="edit"></i> Edit</a>

						@endif
					</div>
					<h5 class="card-title">View Tenant</h5>
					<h6 class="card-subtitle text-muted">View details of a tenant.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-badge value="{{ $tenant->id }}" />
							<x-landlord.show.my-content value="{{ $tenant->data }}" label="Data1" />
							<x-landlord.show.my-date value="{{ $tenant->created_at }}" />
						</tbody>
					</table>
				</div>
			</div>


@endsection
