@extends('layouts.landlord-app')
@section('title', 'All Tenants')
@section('breadcrumb', 'All Tenants')


@section('content')
	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-title">All Tenants</h5>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>ID</th>
						<th>Date</th>
						<th>Status ??</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tenants as $tenant)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
											src="{{ asset('/assets/logo/logo.png') }}" alt="Logo">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0">{{ $tenant->id }}</h6>
										</a>
										<small class="d-block">id: {{ $tenant->id }}</small>
									</div>
								</div>
							</td>
							<td>{{ $tenant->id }}</td>
							<td><x-landlord.list.my-date :value="$tenant->created_at" /></td>
							<td><x-landlord.list.my-badge :value="$tenant->id" /></td>
							<td><x-landlord.list.actions object="Tenant" :id="$tenant->id" :export="false"
									:enable="false" /></td>
						</tr>
					@endforeach
				</tbody>


			</table>
		</div>
		<!-- End Table -->


		<!-- card-body -->
		<div class="card-body">
			<!-- pagination -->
			{{ $tenants->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->
@endsection
