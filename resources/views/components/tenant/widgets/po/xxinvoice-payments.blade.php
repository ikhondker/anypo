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
						<th class="">ID</th>
						<th class="">Date</th>
                        <th class="">Particulars</th>
						<th class="">Bank Ac</th>
						<th class="text-end">Ref/Cheque No</th>
						<th class="text-end">Amount</th>
						<th class="">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($payments as $payment)
						<tr class="">
							<td class="">{{ $payment->id }}</td>
							<td class=""><x-tenant.list.my-date :value="$payment->pay_date"/></td>
                            <td class="">{{ $payment->summary }}</td>
							<td class="">{{ $payment->bank_account->ac_name }}</td>
							<td class="text-end">{{ $payment->cheque_no }}</td>
							<td class="text-end"><x-tenant.list.my-number :value="$payment->amount"/> {{ $payment->currency }}</td>
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
