@extends('layouts.landlord.app')
@section('title','Domain Detail')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ domains('tenants.index') }}" class="text-muted">Domains</a></li>
	<li class="breadcrumb-item active">{{ $domain->id }}</li>
@endsection

@section('content')

    <a href="{{ route('domains.index') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-list"></i> View all</a>
	<h1 class="h3 mb-3">View Domain</h1>

			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('domains.index') }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> View all</a>
						@if (auth()->user()->isSystem())
							<a class="btn btn-sm btn-danger text-white" href="{{ route('domains.edit', $domain->id) }}"><i class="fas fa-edit"></i> Edit</a>
						@endif
					</div>
					<h5 class="card-title">View Domain</h5>
					<h6 class="card-subtitle text-muted">View details of a domain.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-badge value="{{ $domain->id }}" />
							<x-landlord.show.my-text value="{{ $domain->tenant_id }}" label="Tenant ID"/>
							<x-landlord.show.my-text value="{{ $domain->domain }}" label="Domain"/>
							<x-landlord.show.my-content value="{{ $domain->data }}" label="Data1" />
							<x-landlord.show.my-date value="{{ $domain->created_at }}" />
						</tbody>
					</table>
				</div>
			</div>


@endsection

