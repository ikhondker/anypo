@extends('layouts.tenant.app')
@section('title','Countries')

@section('breadcrumb')
	<li class="breadcrumb-item active">Countries</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Countries
		@endslot
		@slot('buttons')
		<x-tenant.buttons.header.create model="Country"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="Country"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Country Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of countries.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>Country</th>
						<th>Name</th>
						<th>Enable?</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($countries as $country)
					<tr>
						<td>{{ $country->country }}</td>
						<td><a href="{{ route('countries.show',$country->country) }}"><strong>{{ $country->name }}</strong></a></td>
						<td><x-tenant.list.my-boolean :value="$country->enable"/></td>
							<td>
								<a href="{{ route('countries.show',$country->country) }}" class="btn btn-light"
									data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
								</a>
							</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $countries->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->


@endsection

