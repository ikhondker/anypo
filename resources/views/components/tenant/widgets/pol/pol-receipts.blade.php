{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
						<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
							<i class="align-middle" data-feather="more-horizontal"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div>
				</div>
				<h5 class="card-title">Purchase Order Receipts</h5>
				<h6 class="card-subtitle text-muted">List of Good Receipts for a Purchase Order Line.</h6>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th class="">SL#</th>
						<th class="">Date</th>
						<th class="text-end">Item</th>
						<th class="text-end">Qty</th>
						<th class="text-end">Amount</th>
						<th class="">Receiver</th>
						<th class="">Warehouse</th>
						<th class="">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($receipts as $receipt)
						<tr class="">
							<td class="">{{ $loop->iteration }}</td>
							<td class="">{{ $receipt->receive_date }}</td>
							<td class="text-end">{{ $receipt->pol->summary }}</td>
							<td class="text-end"><x-tenant.list.my-number :value="$receipt->qty"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$receipt->amount"/></td>
							<td class="">{{ $receipt->receiver->name }}</td>
							<td class="">{{ $receipt->warehouse->name }}</td>
							<td class="table-action">
								<a href="{{ route('receipts.show',$receipt->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
									<i class="align-middle" data-feather="eye"></i></a>
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
</div>
{{-- ============================================================== --}}