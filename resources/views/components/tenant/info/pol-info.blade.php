
<div class="card">
	<div class="card-body">
		<div class="row g-0">
			<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
				<img src="{{ Storage::disk('s3t')->url('flow/pol.jpg') }}" width="240" height="321" class="mt-2" alt="Pol">
			</div>
			<div class="col-sm-9 col-xl-12 col-xxl-9">
				<div class="card-actions float-end">
					@if ($pol->po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
						@can('update', $pol)
							<a href="{{ route('pols.edit', $pol->id ) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i> Edit</a>
						@endcan
					@endif
                    <a class="btn btn-sm btn-light" href="{{ route('pos.show', $pol->po_id ) }}">
                        <i class="far fa-file"></i> PO#{{ $pol->po_id }}</a>

				</div>
				<strong>PO #{{ $pol->po->id }} {{ $pol->po->summary }}</strong>
				<p>{!! nl2br($pol->notes) !!}</p>
				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th>Line #</th>
							<td>{{ $pol->line_num }}</td>
						</tr>
						<tr>
							<th>Item</th>
							<td>{{ $pol->item_description }}</td>
						</tr>
						<tr>
							<th>Ord Qty</th>
							<td>{{ number_format($pol->qty,2) }}</td>
						</tr>
						<tr>
							<th>Rcv Qty</th>
							<td>{{ number_format($pol->received_qty,2) }}</td>
						</tr>
						<tr>
							<th>Unit Price</th>
							<td> {{ $pol->po->currency }} {{ number_format($pol->price+$pol->tax+$pol->gst , 2) }} [ Price {{ number_format($pol->price , 2) }} + Tax {{ number_format($pol->tax , 2) }} +GST {{ number_format($pol->gst , 2) }}]</td>
						</tr>

						<tr>
							<th>Line Amount</th>
							<td>{{ $pol->po->currency }} {{ number_format($pol->amount , 2) }} </td>
						</tr>
						<tr>
							<th>Supplier</th>
							<td>{{ $pol->po->supplier->name }}</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><a href="{{ route('pols.show',$pol->id) }}" class="text-warning d-inline-block">View Purchase Order Line ...</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
