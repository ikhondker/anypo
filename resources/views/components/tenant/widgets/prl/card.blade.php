{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
						@if ($addMore)
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
				<thead>
					<tr>
						@if ( $readOnly )
							<th class="" style="width:2%">LN#</th>
							<th class="" style="width:3%">Item</th>
							<th class="" style="width:23%">Description</th>
							<th class="" style="width:7%">UOM</th>
							<th class="text-end" style="width:5%">Qty</th>
							<th class="text-end" style="width:9%">Price</th>
							<th class="text-end" style="width:8%">Subtotal</th>
							<th class="text-end" style="width:8%">Tax</th>
							<th class="text-end" style="width:8%">GST</th>
							<th class="text-end" style="width:8%">Amount</th>
							<th class="" style="width:10%">Action</th>
						@else
							<th class="" style="width:2%">LN#</th>
							<th class="" style="width:13%">Item</th>
							<th class="" style="width:23%">Description</th>
							<th class="" style="width:7%">UOM</th>
							<th class="text-end" style="width:5%">Qty</th>
							<th class="text-end" style="width:9%">Price</th>
							<th class="text-end" style="width:8%">Subtotal</th>
							<th class="text-end" style="width:8%">Tax</th>
							<th class="text-end" style="width:8%">GST</th>
							<th class="text-end" style="width:8%">Amount</th>
							<th class="" style="width:10%">Action</th>
						@endif

					</tr>
				</thead>

				{{ $lines }}
				
				@if ( $readOnly )
					<!-- Table footer i.e. Totals -->
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
				<!-- End Table footer i.e. Totals -->
				@else
					<tr class="">
						<td colspan="9" class="text-end">
							<strong>TOTAL:</strong>
						</td>
						<td class="text-end">
							<input type="text" class="form-control @error('pr_amount') is-invalid @enderror"
								style="text-align: right;"
								name="pr_amount" id="pr_amount" placeholder="0.00"
								value="{{ old('pr_amount', (isset($pr->amount) ? number_format($pr->amount,2) : "0.00")) }}"
								readonly>
							@error('pr_amount')
									<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</td>
						<td class="">
							{{-- <x-tenant.buttons.show.save/> --}} 
						</td>
					</tr>
				@endif

			</table>
		</div>
	</div>
</div>
