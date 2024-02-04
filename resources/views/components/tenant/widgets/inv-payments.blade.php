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
				<h5 class="card-title">Invoice Payments</h5>
				<h6 class="card-subtitle text-muted">Using the most basic table markup, here’s how .table-based tables look in Bootstrap.</h6>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th class="">SL#</th>
						<th class="">Date</th>
						<th class="">Bank Ac</th>
						<th class="text-end">Ref/Cheque No</th>
						<th class="text-end">Amount</th>
						<th class="text-end">PO#</th>
						<th class="">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($payments as $payment)
						<tr class="">
							<td class="">{{ $payment->id }}</td>
							<td class="">{{ $payment->pay_date }}</td>
							<td class="">{{ $payment->bank_account->ac_name }}</td>
							<td class="text-end">{{ $payment->cheque_no }}</td>
							<td class="text-end"><x-tenant.list.my-number :value="$payment->amount"/></td>
							<td class="text-end">{{ $payment->po_no }}</td>
							<td class="table-action">
								<a href="{{ route('prls.edit',$payment->id) }}" class="text-muted d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">Edit</a> |
								<a href="{{ route('prls.destroy',$payment->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" onclick="return confirm('Do you want to delete this line? Are you sure?')" title="Delete">
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