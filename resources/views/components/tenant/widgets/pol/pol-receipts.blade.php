{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Purchase Order Receipts</h5>
				<h6 class="card-subtitle text-muted">List of Good Receipts for a Purchase Order Line.</h6>
			</div>
			<table class="table table-sm my-2">
				<thead>
					<tr>
						<th class="">#</th>
						<th class="">GRN</th>
						<th class="">Date</th>
						<th class="">Item</th>
						<th class="text-end">Qty</th>
						<th class="text-end">Amount</th>
						<th class="">Receiver</th>
						<th class="">Warehouse</th>
						<th class="">Status</th>
						<th class="">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($receipts as $receipt)
						<tr class="">
							<td class="">{{ $loop->iteration }}</td>
							<td class="">
								<a href="{{ route('receipts.show',$receipt->id) }}" class="text-muted">
									<strong>{{ $receipt->id }}</strong>
								</a>
							</td>
							<td class=""><x-tenant.list.my-date :value="$receipt->receive_date"/></td>
							<td class="">{{ $receipt->pol->item_description }}</td>
							<td class="text-end"><x-tenant.list.my-number :value="$receipt->qty"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$receipt->amount"/></td>
							<td class="">{{ $receipt->receiver->name }}</td>
							<td class="">{{ $receipt->warehouse->name }}</td>
							<td><span class="badge {{ $receipt->status_badge->badge }}">{{ $receipt->status_badge->name}}</span></td>
							<td class="table-action">
								<a href="{{ route('receipts.show',$receipt->id) }}" class="btn btn-light btn-sm"
									data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
								</a>

							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
</div>
{{-- ============================================================== --}}
