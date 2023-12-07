@extends('layouts.landlord-app')
@section('title','Checkouts')
@section('breadcrumb','Checkouts')

@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-title">Checkouts</h5>
		</div>
	
		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
				<tr>
					<th>Name</th>
					<th>Date</th>
					<th>Product</th>
					<th>Site</th>
					<th>Price</th>
					<th>Status</th>
					<th style="width: 5%;">Action</th>
				</tr>
				</thead>
		
				<tbody>
					@foreach ($checkouts as $checkout)
					<tr>
						<td>
						<div class="d-flex align-items-center">
							<div class="flex-shrink-0">
								<img class="avatar avatar-sm avatar-circle" src="{{ asset('/assets/logo/logo.png') }}" alt="Checkout">
							</div>
							<div class="flex-grow-1 ms-3">
								<a class="d-inline-block link-dark" href="#">
									<h6 class="text-hover-primary mb-0">{{ $checkout->account_name }}</h6>
								</a>
								<small class="d-block">{{ $checkout->email }}</small>
							</div>
						</div>
						</td>
						<td><x-landlord.list.my-date :value="$checkout->checkout_date"/></td>
						<td>{{ $checkout->product->sku }}</td>
						<td>{{ $checkout->site }}</td>
						<td><x-landlord.list.my-number :value="$checkout->price"/></td>
						<td><x-landlord.list.my-badge :value="$checkout->status->name" badge="{{ $checkout->status->badge }}"/></td>
						<td><x-landlord.list.actions object="Checkout" :id="$checkout->id" :export="false" :enable="false"/></td>
					</tr>
				
				@endforeach
				</tbody>
			</table>
		</div>
		<!-- End Table -->
	
		<!-- card-body -->
		<div class="card-body">
			<!-- pagination -->
			{{ $checkouts->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->


@endsection
