<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
						<img src="{{ Storage::disk('s3t')->url('flow/receipt.jpg') }}" width="240" height="321" class="mt-2" alt="Receipt">
					</div>
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<h4>RECEIPT #{{ $receipt->id }} </h4>
						<p>{!! nl2br($receipt->notes) !!}</p>
						<table class="table table-sm my-2">
							<tbody>

								<tr>
									<th>PO #</th>
									<td>
										<a class="text-info" href="{{ route('pos.show',$receipt->pol->po_id) }}">
											{{ "#". $receipt->pol->po_id. " - ". $receipt->pol->po->summary }}
										</a>
									</td>
								</tr>
								<tr>
									<th>Supplier</th>
									<td>{{  $receipt->pol->po->supplier->name }}</td>
								</tr>
								<tr>
									<th>Po Line</th>
									<td>{{ $receipt->pol->line_num }}. {{ $receipt->pol->item_description }}</td>
								</tr>
								<tr>
									<th>Order Qty</th>
									<td>{{ $receipt->pol->qty }} {{ $receipt->pol->uom->name }}</td>
								</tr>
								<tr>
									<th>Receive Qty</th>
									<td>{{  $receipt->qty }} {{ $receipt->pol->uom->name }}</td>
								</tr>
								<tr>
									<th>Receipt Date</th>
									<td>{{ ($receipt->receive_date <> "") ? strtoupper(date('d-M-y', strtotime($receipt->receive_date))) : "" }}</td>
								</tr>
								<tr>
									<th>Status</th>
									<td><span class="badge {{ $receipt->status_badge->badge }}">{{ $receipt->status_badge->name}}</span></td>
								</tr>
								{{-- <tr>
									<th>Payment Status</th>
									<td><span class="badge {{ $receipt->pay_status_badge->badge }}">{{ $receipt->pay_status_badge->name}}</span></td>
								</tr> --}}
								{{-- <tr>
									<th>PO <a href="{{ route('pos.show',$receipt->po_id) }}" class="text-warning d-inline-block">#{{ $receipt->po_id }}</a> </th>
									<td>{{ $receipt->po->summary }} </td>
								</tr> --}}
								<tr>
									<td>&nbsp;</td>
									<td><a href="{{ route('receipts.show',$receipt->id) }}" class="text-warning d-inline-block">xx View Receipt ...</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>