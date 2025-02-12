<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
				<h5 class="card-title">Services & Add-ons</h5>
			</div>
			<div class="col-md-6 col-xl-8">

				<div class="text-sm-end">
					<a href="{{ route('services.index') }}" class="btn btn-light btn-lg me-2"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
						<i data-lucide="shopping-cart"></i> Buy More User</a>
				</div>
			</div>
		</div>

		<table class="table w-100">
			<thead>
				<tr>
					<th class="align-middle">#</th>
					<th class="align-middle">Service Name</th>
					<th class="align-middle">Account</th>
					<th>Start</th>
					<th>End</th>
					<th class="align-middle">Licensed User</th>
					<th class="align-middle">Fee/mo</th>
					<th>Enable</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($services as $service)
					<tr>
						<td>
							<img src="{{ Storage::disk('s3l')->url('logo/'.$service->account->logo) }}" width="32" height="32" class="rounded-circle my-n1" alt="{{ $service->name }}" title="{{ $service->name }}">
						</td>
						<td>{{ $service->name }}</td>
						<td>{{ $service->account->name }}</td>
						<td>{{ strtoupper(date('d-M-Y', strtotime( $service->start_date))) }}</td>
						<td>
							@if ($service->end_date <> NULL)
							{{ strtoupper(date('d-M-Y', strtotime( $service->end_date))) }}
							@endif
						</td>
						<td><span class="badge badge-subtle-success">{{ $service->user }}</span></td>
						<td><x-landlord.list.my-number :value="$service->price" />$</td>
						<td><x-landlord.list.my-enable :value="$service->enable" /></td>
						<td>
							@if ($service->addon && $service->enable)
								<a href="{{ route('services.delete', $service->id) }}"
									class="btn btn-light sw2-advance" data-entity="AddOn"
									data-name="{{ $service->name }}"
									data-status="Remove" data-bs-toggle="tooltip"
									data-bs-placement="top" title="Remove Add-On">
									<i data-lucide="x-circle" class="text-danger"></i> Remove
								</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>



	</div>
</div>

