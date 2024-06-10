@extends('layouts.landlord.app')
@section('title', 'List of Products')
@section('breadcrumb', 'List of Products')

@section('content')


	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-title">List of Products</h5>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>Month</th>
						<th>User</th>
						<th>GB</th>
						<th>Price</th>
						<th>Qty</th>
						<th>Enable</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($products as $product)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
											src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Logo">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0">{{ $product->name }}
												@if ($product->addon)
													<i class="bi bi-check-circle-fill text-danger" style="font-size: 1rem;"
														data-bs-toggle="tooltip" data-bs-placement="top" title="Addon"></i>
												@endif
											</h6>
										</a>
										<small class="d-block">SKU:{{ $product->sku }}</small>
									</div>
								</div>
							</td>
							<td><x-landlord.list.my-integer :value="$product->mnth" /></td>
							<td>{{ $product->user }}</td>
							<td> {{ $product->gb }}</td>
							<td><x-landlord.list.my-number :value="$product->price" /></td>
							<td><x-landlord.list.my-integer :value="$product->sold_qty" /></td>
							<td><x-landlord.list.my-enable :value="$product->enable" /></td>
							<td><x-landlord.list.actions object="Product" :id="$product->id" :edit="false"
									:enable="false" /></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- End Table -->

	</div>
	<!-- End Card -->

@endsection
