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
				<h5 class="card-title">Purchase Order Invoices</h5>
				<h6 class="card-subtitle text-muted">Using the most basic table markup, here’s how .table-based tables look in Bootstrap.</h6>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th class="">ID#</th>
						<th class="">PO#</th>
						<th class="">Invoice No</th>
						<th class="">Date</th>
						<th class="">Summary</th>
						<th class="">Currency</th>
						<th class="text-end">Amount</th>
						<th class="text-end">Paid Amount</th>
						<th class="">Status</th>
						<th class="">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($invoices as $invoice)
						<tr class="">
							<td class="">{{ $invoice->id }}</td>
							<td class="">{{ $invoice->po_id }}</td>
							<td class="">{{ $invoice->invoice_no }}</td>
							<td class="">{{ $invoice->inv_date }}</td>
							<td class="">{{ $invoice->summary }}</td>
							<td class="">{{ $invoice->currency }}</td>
							<td class="text-end"><x-tenant.list.my-number :value="$invoice->amount"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$invoice->amount_paid"/></td>
							<td><x-tenant.list.my-badge :value="$invoice->status"/></td>
							<td class="table-action">
								<a href="{{ route('invoices.show',$invoice->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
									<i class="align-middle" data-feather="eye"></i></a>
								<a href="{{ route('payments.create',$invoice->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Invoice">
										<i class="align-middle" data-feather="dollar-sign"></i></a>
								<a href="{{ route('prls.edit',$invoice->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
									<i class="align-middle" data-feather="edit"></i></a>
									<a href="{{ route('prls.destroy',$invoice->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" onclick="return confirm('Do you want to delete this line? Are you sure?')" title="Delete">
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