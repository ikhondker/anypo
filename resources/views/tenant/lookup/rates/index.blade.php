@extends('layouts.app')
@section('title','Exchange Rates')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Exchange Rates
		@endslot
		@slot('buttons')
			
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">
			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Rate" :export="true"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Exchange Rates
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>Rate</th>
								<th>Date</th>
								<th>Currency</th>
								<th>Base Currency</th>
								<th>From Date</th>
								<th>To Date</th>
								<th class="text-end">Rate</th>
								<th class="text-end">Inverse Rate</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($rates as $rate)
							<tr>
								<td>{{ ++$i }}</td>
								<td><x-tenant.list.my-date :value="$rate->rate_date"/></td>
								<td>{{ $rate->currency }}</td>
								<td>{{ $rate->fc_currency }}</td>
								<td><x-tenant.list.my-date :value="$rate->from_date"/></td>
								<td><x-tenant.list.my-date :value="$rate->to_date"/></td>
								<td class="text-end">{{ number_format($rate->rate, 6)  }}</td>
								<td class="text-end">{{ number_format($rate->inverse_rate, 6)  }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $rates->links() }}
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

