@extends('layouts.app')
@section('title','Currencies')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Currency
		@endslot
		@slot('buttons')
		<x-tenant.buttons.header.create object="Currency"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Currency"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Currency Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of currencies.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>Currency</th>
								<th>Name</th>
								<th>Country</th>
								<th>Enable?</th>
								<th>Exchange Rate Available?</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($currencies as $currency)
							<tr>
								<td>{{ $currency->currency }}</td>
								<td>{{ $currency->name }}</td>
								<td>{{ $currency->country }}</td>
								<td><x-tenant.list.my-boolean :value="$currency->enable"/></td>
								<td><x-tenant.list.my-boolean :value="$currency->rates"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Currency" :id="$currency->currency" :show="false"/>
									<a href="{{ route('currencies.destroy',$currency->currency) }}" class="me-2 modal-boolean-advance" 
											data-entity="Currency" data-name="{{ $currency->currency }}" data-status="{{ ($currency->enable ? 'Disable' : 'Enable') }}"
											data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($currency->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($currency->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $currencies->links() }}
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

	@include('tenant.includes.modal-boolean-advance')

@endsection

