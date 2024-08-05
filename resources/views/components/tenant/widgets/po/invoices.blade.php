{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
						<a href="{{ route('invoices.create-for-po', $poid) }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Create Invoice</a>
					</div>
				</div>
				<h5 class="card-title">Purchase Order Invoices</h5>
				<h6 class="card-subtitle text-muted">List of Purchase Order Invoices.</h6>
			</div>
			<table class="table">
				<thead>
					<tr>

						<th class="">PO#</th>
						<th class="">Invoice No</th>
						<th class="">Date</th>
						<th class="">Summary</th>
						<th class="text-end">Amount</th>
						<th class="text-end">Paid</th>
						<th class="">Status</th>
						<th class="">Pay Status</th>
						<th class="">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($invoices as $invoice)
						<tr class="">

							<td class="">{{ $invoice->po_id }}</td>
							<td class="">
                                <a href="{{ route('invoices.show',$invoice->id) }}" class="text-muted">
									<strong>{{ $invoice->invoice_no }}</strong>
								</a>
                            </td>
							<td class=""><x-tenant.list.my-date :value="$invoice->invoice_date"/></td>
							<td class="">{{ $invoice->summary }}</td>
							<td class="text-end">
                                {{ number_format($invoice->amount, 2) }} {{ $invoice->currency }}
                            </td>
							<td class="text-end">
                                    {{ number_format($invoice->amount_paid, 2) }} {{ $invoice->currency }}
                            </td>
							<td><span class="badge {{ $invoice->status_badge->badge }}">{{ $invoice->status_badge->name}}</span></td>
							<td><span class="badge {{ $invoice->pay_status_badge->badge }}">{{ $invoice->pay_status_badge->name}}</span></td>
							<td>
								<a href="{{ route('invoices.show',$invoice->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
									<i class="align-middle" data-lucide="eye"></i></a>
								<a href="{{ route('invoices.edit',$invoice->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
									<i class="align-middle" data-lucide="edit"></i></a>
								<a href="{{ route('payments.create',$invoice->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Pay">
									<i class="align-middle" data-lucide="dollar-sign"></i></a>
							</td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
</div>
{{-- ============================================================== --}}
