@extends('layouts.app')
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
		<x-tenant.buttons.header.create object="Country"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Country"/>
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
								<td>{{ $country->name }}</td>
								<td><x-tenant.list.my-boolean :value="$country->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Country" :id="$country->country" :show="false"/>
									<a href="{{ route('countries.destroy',$country->country) }}" class="me-2 sw2-advance" 
										data-entity="Country" data-name="{{ $country->name }}" data-status="{{ ($country->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($country->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($country->enable ? 'bell-off' : 'bell') }}"></i>
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

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

	 @include('shared.includes.js.sw2-advance')

@endsection

