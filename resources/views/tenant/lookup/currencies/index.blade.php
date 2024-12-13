@extends('layouts.tenant.app')
@section('title','Currencies')
@section('breadcrumb')
	<li class="breadcrumb-item active">Currencies</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Currency
		@endslot
		@slot('buttons')
		@if (auth()->user()->isSystem())
			<a href="{{ route('currencies.create') }}" class="btn btn-danger me-1"><i data-lucide="plus"></i>Create</a>
		@endif
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="Currency"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-info">{{ request('term') }}</strong>
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
						<th>Code</th>
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
						<td><a href="{{ route('currencies.show',$currency->currency) }}"><strong>{{ $currency->name }}</strong></a></td>
						<td>{{ $currency->country }}</td>
						<td><x-tenant.list.my-enable :value="$currency->enable"/></td>
						<td><x-tenant.list.my-boolean :value="$currency->rates"/></td>
						<td>
							<a href="{{ route('currencies.show',$currency->currency) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
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

@endsection

