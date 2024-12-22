@extends('layouts.tenant.app')
@section('title','Tenant Status Lists')
@section('breadcrumb')
	<li class="breadcrumb-item active">Statuses</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Status Lists
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="status"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">

		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="Status" :export="true"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-info">{{ request('term') }}</strong>
				@else
					Status Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of all Statuses.</h6>
		</div>

		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Code</th>
						<th>Name</th>
						<th>Badge</th>
						<th>Icon</th>
						<th>Enable?</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($statuses as $status)
					<tr>
						<td>{{ $statuses->firstItem() + $loop->index}}</td>
						<td>{{ $status->code }}</td>
						<td><a href="{{ route('statuses.show',$status->code) }}"><strong>{{ $status->name }}</strong></a></td>
						<td><button class="btn btn-sm btn-{{ $status->badge }}">{{ $status->badge }}</button></td>
						<td><i data-lucide="{{ $status->icon }}"></i> </td>
						<td><x-tenant.list.my-boolean :value="$status->enable"/></td>
						<td>
							<a href="{{ route('statuses.show',$status->code) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $statuses->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

