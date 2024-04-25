{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
						@if ($showAddMore)
							<div class="form-check form-switch">
								<input class="form-check-input m-1" type="checkbox" id="add_row" name="add_row" checked>
								<label class="form-check-label" for="add_row">... add another row</label>
							</div>
						@endif 
					</div>
				</div>
				<h5 class="card-title">Requisition Lines</h5>
				<h6 class="card-subtitle text-muted">List of Requisition Lines.</h6>

			</div>
			<table class="table table-striped table-hover">
				<x-tenant.widgets.prl.pr-lines-table-header/>
				<tbody>
					@forelse  ($prls as $prl)
						<tr class="">
							<td class="">{{ $prl->line_num }}</td>
							<td class="">{{ $prl->item->code }}</td>
							<td class="">{{ $prl->item_description }}</td>
							<td class="">{{ $prl->uom->name }}</td>
							<td class="text-end">{{ $prl->qty }}</td>
							<td class="text-end"><x-tenant.list.my-number :value="$prl->price"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$prl->sub_total"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$prl->tax"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$prl->gst"/></td>
							<td class="text-end"><x-tenant.list.my-number :value="$prl->amount"/></td>
							<td class="">
								@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
									<a href="{{ route('prls.edit',$prl->id) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top"title="Edit">
										<i class="align-middle" data-feather="edit"></i></a>
									<a href="{{ route('prls.destroy',$prl->id) }}" class="text-muted sw2-advance" 
										data-entity="LINE #" data-name="{{ $prl->line_num }}" data-status="Delete"
										data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
										<i class="align-middle" data-feather="trash-2"></i>
									</a>
								@endif
							</td>
						</tr>
					@empty
						{{-- @include('tenant.includes.pr.pr-line-add') --}}
						{{-- @include('tenant.includes.pr.pr-footer-edit') --}}
					@endforelse
					

					{{ $slot }}

					{{-- <!-- Table footer i.e. Totals  -->
					<tr>
						<td class="" colspan="2" scope="col"> 
							@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
								<a href="{{ route('prls.add-line', $pr->id) }}" class="text-warning d-inline-block"><i data-feather="plus-square"></i> Add Lines</a>
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
					<!-- End Table footer i.e. Totals  --> --}}
				</tbody>
			</table>
		</div>
	</div>
</div>

@include('shared.includes.js.sw2-advance')
{{-- ============================================================== --}}