<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
						<img src="{{ Storage::disk('s3t')->url('flow/supplier.jpg') }}" width="240" height="321" class="mt-2" alt="Supplier">
					</div>
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<h4>SUPPLIER: {{ $supplier->name }}</h4>
						<p>{!! nl2br($supplier->notes) !!}</p>
						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th>Contact Person</th>
									<td>{{ $supplier->contact_person }}</td>
								</tr>
								<tr>
									<th>Cell</th>
									<td>{{ $supplier->cell }}</td>
								</tr>
								<tr>
									<th>Email | Web</th>
									<td>{{ $supplier->email  .' | '. $supplier->website}}</td>
								</tr>
								<tr>
									<th>Address</th>
									<td>{{ $supplier->address1 .' '.$supplier->address2  }}</td>
								</tr>
								<tr>
									<th>City-State-Zip-Country</th>
									<td>{{ $supplier->city .' '.$supplier->state.' '.$supplier->zip .' '.$supplier->country  }}</td>
								</tr>
								
								<tr>
									<th>Enable</th>
									<td><span class="badge {{ ($supplier->closed ? 'bg-danger' : 'bg-success') }}">{{ ($supplier->enable ? 'Yes' : 'No') }}</span></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><a href="{{ route('suppliers.show',$supplier->id) }}" class="text-warning d-inline-block">View Supplier Detail ...</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>