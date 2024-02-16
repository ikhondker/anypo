{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Requisition Lines</h5>
				<h6 class="card-subtitle text-muted">List of Requisition Lines.</h6>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th class="">LINE#</th>
						<th class="">Item</th>
						<th class="">Summary</th>
						<th class="">UOM</th>
						<th class="text-end">Qty</th>
						<th class="text-end">Price</th>
						<th class="text-end">Sub Total</th>
						<th class="text-end">Tax</th>
						<th class="text-end">GST</th>
						<th class="text-end">Amount</th>
						<th class="">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($prls as $prl)
						@if ( $selected_prl_id == $prl->id )
							@include('tenant.includes.pr.pr-line-edit')
						@else

							<tr class="">
								<td class="">{{ $prl->line_num }}</td>
								<td class="">{{ $prl->item->name }}</td>
								<td class="">{{ $prl->summary }}</td>
								<td class="">{{ $prl->uom->name }}</td>
								<td class="text-end">{{ $prl->qty }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->price"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->sub_total"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->tax"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->gst"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$prl->amount"/></td>
								<td class="">
									@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
										<a href="{{ route('prls.edit',$prl->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top"title="Edit"><i class="align-middle" data-feather="edit"></i>
										</a>
										<a href="{{ route('prls.destroy',$prl->id) }}" class="text-muted modal-boolean-advance" 
											data-entity="LINE" data-name="LINE #{{ $prl->line_num }}" data-status="Delete"
											data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
											<i class="align-middle" data-feather="trash-2"></i>
										</a>


									@endif
								</td>
							</tr>
						@endif

					@endforeach

					@if ($add)
						@include('tenant.includes.pr.pr-line-add')

						@include('tenant.includes.pr.pr-footer-edit')
					@endif
					@if ($edit)
						@include('tenant.includes.pr.pr-footer-edit')
					@endif
					@if ($show)
						<tr>
							<td class="" colspan="2" scope="col"> 
								@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
									<a href="{{ route('prls.createline', $pr->id) }}" class="text-warning d-inline-block"><i data-feather="plus-square"></i> Add Lines</a>
								@endif
							</td>
							<td class="" colspan="3" scope="col">&nbsp;</td>
							<td class="text-end" scope="col"><strong>TOTAL ({{ $pr->currency }}) :</strong></td>
							<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$pr->sub_total"/></strong></td>
							<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$pr->tax"/></strong></td>
							<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$pr->gst"/></strong></td>
							<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$pr->amount"/></strong></td>
							<td class="" scope="col">&nbsp</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
{{-- ============================================================== --}}