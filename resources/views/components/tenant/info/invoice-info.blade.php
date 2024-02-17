<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
						<img src="{{ asset('/img3.jpg')}}" width="180" height="180" class="mt-2" alt="Project">
					</div>
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<h4>INVOICE #{{ $invoice->invoice_no  }} : {{ $invoice->summary }}</h4>
						<p>{{ $invoice->notes }}</p>
						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th>Supplier</th>
									<td>{{ $invoice->supplier->name  }}</td>
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
									<th>Status</th>
									<td><span class="badge {{ $invoice->status_badge->badge }}">{{ $invoice->status_badge->name}}</span></td>
								</tr>
								<tr>
									<th>Payment Status</th>
									<td><span class="badge {{ $invoice->pay_status_badge->badge }}">{{ $invoice->pay_status_badge->name}}</span></td>
								</tr>
								<tr>
									<th>PO <a href="{{ route('pos.show',$invoice->po_id) }}" class="text-warning d-inline-block">#{{ $invoice->po_id }}</a>  </th>
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
	</div>
</div>