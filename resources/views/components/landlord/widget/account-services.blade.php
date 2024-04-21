<!-- Card -->
<div class="card">

	<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
		<h5 class="card-header-title">Services & Add-ons </h5>
		<a class="btn btn-primary btn-sm" href="{{ route('services.index') }}">
			<i class="bi bi-cart-plus me-1"></i> Buy More User
		</a>
	</div>

	<!-- Table -->
	<div class="table-responsive">
		<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
			<thead class="thead-light">
				<tr>
					<th>Name</th>
					<th>From</th>
					<th>User</th>
					<th>Price (USD)</th>
					<th>Enable</th>
					
				</tr>
			</thead>

			<tbody>
				@foreach ($services as $service)
					<tr>
						<td>
							<div class="d-flex align-items-center">
								<div class="flex-shrink-0">
									<img class="avatar avatar-sm avatar-circle" src="{{ Storage::disk('s3l')->url('logo/'.$service->account->logo) }}"
										alt="Image Description">
								</div>

								<div class="flex-grow-1 ms-3">
										<h6 class="text-hover-primary mb-0">{{ $service->name }}</h6>
									<small class="d-block">Account : {{ $service->account->name }} [#{{ $service->account_id }}]</small>
								</div>
							</div>
						</td>
						<td><x-landlord.list.my-date :value="$service->start_date" /></td>
						<td>
							{{-- <span class="badge bg-primary rounded-pill">{{ $service->mnth }}</span> --}}
							<span class="badge bg-primary rounded-pill">{{ $service->user }}</span>
							{{-- <span class="badge bg-primary rounded-pill">{{ $service->gb }}</span> --}}
						</td>
						<td><x-landlord.list.my-number :value="$service->price" /></td>
						<td><x-landlord.list.my-enable value="{{ $service->enable }}" /></td>

						
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- End Table -->

</div>
<!-- End Card -->