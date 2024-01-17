{{-- ================================================================== --}}
<div class="row">
	<div class="col-8 col-xl-8">
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
				<h5 class="card-title">Purchase Order Payments</h5>
				<h6 class="card-subtitle text-muted">Using the most basic table markup, here’s how .table-based tables look in Bootstrap.</h6>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th class="">SL#</th>
						<th class="">Date</th>
						<th class="">Receiver</th>
						<th class="">Warehouse</th>
						<th class="text-end">Item</th>
						<th class="text-end">Qty</th>
						<th class="text-end">PO#</th>
						<th class="">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($receipts as $receipt)
						<tr class="">
							<td class="">{{ $loop->iteration }}</td>
							<td class="">{{ $receipt->receive_date }}</td>
							<td class="">{{ $receipt->receiver_id }}</td>
							<td class="">{{ $receipt->warehouse_id }}</td>
							<td class="text-end">{{ $receipt->pol_id }}</td>
							<td class="text-end"><x-tenant.list.my-number :value="$receipt->qty"/></td>
							<td class="text-end">{{ $receipt->po_no }}</td>
							<td class="table-action">
								<a href="{{ route('prls.edit',$receipt->id) }}" class="text-muted d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">Edit</a> |
								<a href="{{ route('prls.destroy',$receipt->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" onclick="return confirm('Do you want to delete this line? Are you sure?')" title="Delete">
									<i class="align-middle" data-feather="trash-2"></i>
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