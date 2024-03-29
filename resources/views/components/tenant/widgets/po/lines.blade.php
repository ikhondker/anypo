{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Purchase Order Lines</h5>
				<h6 class="card-subtitle text-muted">List of Purchase Order Lines.</h6>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th class="">LINE#</th>
						<th class="">Item</th>
						<th class="">Summary</th>
						<th class="">UOM</th>
						<th class="text-end">Qty</th>
						<th class="text-end">Received</th>
						<th class="text-end">Price</th>
						<th class="text-end">Sub Total</th>
						<th class="text-end">Tax</th>
						<th class="text-end">GST</th>
						<th class="text-end">Amount</th>
						<th class="text-end">Status</th>
						<th class="">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($pols as $pol)
						@if ( $selected_pol_id == $pol->id )
							@include('tenant.includes.po.po-line-edit')
						@else
							<tr class="">
								<td class="">{{ $pol->line_num }}</td>
								<td class="">{{ $pol->item->name }}</td>
								<td class="">{{ $pol->summary }}</td>
								<td class="">{{ $pol->uom->name }}</td>
								<td class="text-end">{{ $pol->qty }}</td>
								<td class="text-end">{{ $pol->received_qty }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$pol->price"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$pol->sub_total"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$pol->tax"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$pol->gst"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$pol->amount"/></td>
								<td class="text-end"><span class="badge {{ $pol->close_status_badge->badge }}">{{ $pol->close_status_badge->name}}</span></td>
								<td class="table-action">
									<a href="{{ route('pols.show',$pol->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
										<i class="align-middle" data-feather="eye"></i></a>
									
									@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
										<a href="{{ route('pols.edit',$pol->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
											<i class="align-middle" data-feather="edit"></i></a>
									
										<a href="{{ route('pols.destroy',$pol->id) }}" class="text-muted modal-boolean-advance" 
											data-entity="Line #" data-name="{{ $pol->line_num }}" data-status="Delete"
											data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
											<i class="align-middle" data-feather="trash-2"></i>
										</a>
									@elseif ($po->auth_status == App\Enum\AuthStatusEnum::APPROVED->value)
										<a href="{{ route('pols.receipt',$pol->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Goods Receipt">
											<i class="align-middle" data-feather="file-text"></i></a>
									@endif	
						
								</td>
							</tr>
						@endif

					@endforeach

					@if ($add)
						@include('tenant.includes.po.po-line-add')
						{{-- @include('tenant.includes.po.po-footer-edit') --}}
					@endif
					@if ($add || $edit)
						@include('tenant.includes.po.po-footer-edit')
					@endif
					@if ($show)
						<tr>
							<td class="" colspan="2" scope="col"> 
								@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
									<a href="{{ route('pols.add-line', $po->id) }}" class="text-warning d-inline-block"><i data-feather="plus-square"></i> Add Lines</a>
								@endif
							</td>
							<td class="" colspan="4" scope="col">&nbsp;</td>
							<td class="text-end" scope="col"><strong>TOTAL ({{ $po->currency }}):</strong></td>
							<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->sub_total"/></strong></td>
							<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->tax"/></strong></td>
							<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->gst"/></strong></td>
							<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->amount"/></strong></td>
							<td class="" scope="col">#</td>
							<td class="" scope="col">#</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
{{-- ============================================================== --}}