{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
						<div class="card-actions float-end">
							@can('createForInvoice', App\Models\Tenant\Payment::class)
								<a href="{{ route('payments.create-for-invoice',$invoiceId) }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Create Payment</a>
							@endcan
						</div>
					</div>
				</div>
				<h5 class="card-title">Invoice Payments</h5>
				<h6 class="card-subtitle text-muted">List of Invoice Payments.</h6>
			</div>
			<table class="table table-sm my-2">
				<thead>
					<tr>
						<th>ID</th>
						<th>Date</th>
						<th>Particulars</th>
						<th>Bank Ac</th>
						<th>Ref/Cheque No</th>
						<th class="text-end">Amount</th>
                        <th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($payments as $payment)
						<tr>
							<td>{{ $payment->id }}</td>
							<td><x-tenant.list.my-date :value="$payment->pay_date"/></td>
							<td>{{ $payment->summary }}</td>
							<td>{{ $payment->bank_account->ac_name }}</td>
							<td>{{ $payment->cheque_no }}</td>
							<td class="text-end"><x-tenant.list.my-number :value="$payment->amount"/> {{ $payment->currency }}</td>
                            <td><span class="badge {{ $payment->status_badge->badge }}">{{ $payment->status_badge->name}}</span></td>
							<td class="table-action">
								<a href="{{ route('payments.show',$payment->id) }}" class="btn btn-light btn-sm"
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
