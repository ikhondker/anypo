
<div class="card">
	<div class="card-body">
		<div class="row g-0">
			<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
				<img src="{{ Storage::disk('s3t')->url('flow/invoice.jpg') }}" width="240" height="321" class="mt-2" alt="Invoice">
			</div>
			<div class="col-sm-9 col-xl-12 col-xxl-9">
				<div class="card-actions float-end">
					@if ($invoice->status <> App\Enum\Tenant\InvoiceStatusEnum::POSTED->value)
						@can('edit', $invoice)
							<a href="{{ route('invoices.edit', $invoice->id ) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Edit</a>
						@endcan
					@endif
					<a href="{{ route('invoices.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>

				<strong>INVOICE #{{ $invoice->invoice_no }} : {{ $invoice->summary }}</strong>
				<p>{!! nl2br($invoice->notes) !!}</p>
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Supplier</th>
							<td>{{ $invoice->supplier->name }}</td>
						</tr>
						<tr>
							<th>Invoice Date</th>
							<td>{{ ($invoice->invoice_date <> "") ? strtoupper(date('d-M-y', strtotime($invoice->invoice_date))) : "" }}</td>
						</tr>
						<tr>
							<th>Amount</th>
							<td>{{ number_format($invoice->amount , 2) }} {{ $invoice->currency }}</td>
						</tr>
						<tr>
							<th>Paid Amount</th>
							<td>{{ number_format($invoice->amount_paid , 2) }} {{ $invoice->currency }}</td>
						</tr>

						<tr>
							<th>Status</th>
							<td><span class="badge {{ $invoice->status_badge->badge }}">{{ $invoice->status_badge->name}}</span></td>
						</tr>
						<tr>
							<th>Payment Status</th>
							<td><span class="badge {{ $invoice->pay_status_badge->badge }}">{{ $invoice->pay_status_badge->name}}</span></td>
						</tr>
						<tr>
							<th>PO <a href="{{ route('pos.show',$invoice->po_id) }}" class="text-muted"><strong>>#{{ $invoice->po_id }}</strong></a> </th>
							<td>{{ $invoice->po->summary }} </td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><a href="{{ route('invoices.show',$invoice->id) }}" class="text-warning d-inline-block">xx View Invoice ...</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
