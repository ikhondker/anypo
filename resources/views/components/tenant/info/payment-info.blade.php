
<div class="card">
	<div class="card-body">
		<div class="row g-0">
			<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
				<img src="{{ Storage::disk('s3t')->url('flow/payment.jpg') }}" width="240" height="321" class="mt-2" alt="Payment">
			</div>
			<div class="col-sm-9 col-xl-12 col-xxl-9">
				<div class="card-actions float-end">
					@if (auth()->user()->isSystem())
						<a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-sm btn-danger text-white" ><i data-lucide="edit"></i> Edit</a>
					@endif
					<a href="{{ route('payments.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
				</div>
				<strong>PAYMENT #{{ $payment->id }}</strong>
				<p>{!! nl2br($payment->notes) !!}</p>
				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th>Ref/Cheque#</th>
							<td>{{ $payment->cheque_no }}</td>
						</tr>
						<tr>
							<th>Payment Date</th>
							<td>{{ ($payment->pay_date <> "") ? strtoupper(date('d-M-y', strtotime($payment->pay_date))) : "" }}</td>
						</tr>
						<tr>
							<th>Payment Amount</th>
							<td>{{ number_format($payment->amount , 2) }} {{ $payment->currency }}</td>
						</tr>
						<tr>
							<th>Bank Ac</th>
							<td>{{ $payment->bank_account->ac_name }}</td>
						</tr>
						<tr>
							<th>Status</th>
							<td><span class="badge {{ $payment->status_badge->badge }}">{{ $payment->status_badge->name}}</span></td>
						</tr>



						<tr>
							<th>Invoice</th>
							<td>
								<a class="text-muted" href="{{ route('invoices.show',$payment->invoice_id) }}">
									<strong>{{ $payment->invoice->invoice_no }}</strong>
								</a>
							</td>
						</tr>
						<tr>
							<th>Invoice Date</th>
							<td>{{ ($payment->invoice->invoice_date <> "") ? strtoupper(date('d-M-y', strtotime($payment->invoice->invoice_date))) : "" }}</td>
						</tr>
						<tr>
							<th>Invoice Amount</th>
							<td>{{ number_format($payment->invoice->amount , 2) }} {{ $payment->currency }}</td>
						</tr>
						<tr>
							<th>Supplier</th>
							<td>{{ $payment->invoice->supplier->name }}</td>
						</tr>
						<tr>
							<th>PO #</th>
							<td>
								<a class="text-muted" href="{{ route('pos.show',$payment->invoice->po_id) }}">
									{{ "#". $payment->invoice->po_id. " - ". $payment->invoice->po->summary }}
								</a>
							</td>
						</tr>

						{{-- <tr>
							<th>Payment Status</th>
							<td><span class="badge {{ $payment->pay_status_badge->badge }}">{{ $payment->pay_status_badge->name}}</span></td>
						</tr> --}}
						{{-- <tr>
							<th>PO <a href="{{ route('pos.show',$payment->po_id) }}" class="text-warning d-inline-block">#{{ $payment->po_id }}</a></th>
							<td>{{ $payment->po->summary }}</td>
						</tr> --}}
						<tr>
							<td>&nbsp;</td>
							<td><a href="{{ route('payments.show',$payment->id) }}" class="text-warning d-inline-block">xx View Payment ...</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
