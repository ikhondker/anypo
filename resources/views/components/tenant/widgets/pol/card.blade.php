{{-- ================================================================== --}}
<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<div class="dropdown position-relative">
				@if ($addMore)
					<div class="form-check form-switch">
						<input class="form-check-input m-1" type="checkbox" id="add_row" name="add_row" checked>
						<label class="form-check-label" for="add_row">... add another row</label>
					</div>
				@else
					@if ($po->auth_status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
						<a href="{{ route('pols.add-line', $po->id) }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Add Line</a>
					@endif
				@endif
			</div>
		</div>
		<h5 class="card-title">Purchase Order Lines</h5>
		<h6 class="card-subtitle text-muted">List of Purchase Order Lines.</h6>
	</div>
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				@if ( $readOnly )
					<th class="" style="width:2%">LN#</th>
					<th class="" style="width:5%" >Item</th>
					<th class="" style="width:23%">Description</th>
					<th class="" style="width:7%">UOM</th>
					<th class="text-end" style="width:5%">Qty</th>
					<th class="text-end" style="width:5%">Received</th>
					<th class="text-end" style="width:9%">Price</th>
					<th class="text-end" style="width:8%">Subtotal</th>
					<th class="text-end" style="width:8%">Tax</th>
					<th class="text-end" style="width:8%">GST</th>
					<th class="text-end" style="width:8%">Amount</th>
					<th class="text-end">Status</th>
					<th class="" style="width:10%">Actions</th>
				@else
					<th class="" style="width:2%">LN#</th>
					<th class="" style="width:13%" >Item</th>
					<th class="" style="width:23%">Description</th>
					<th class="" style="width:7%">UOM</th>
					<th class="text-end" style="width:5%">Qty</th>
					<th class="text-end" style="width:5%">Received</th>
					<th class="text-end" style="width:9%">Price</th>
					<th class="text-end" style="width:8%">Subtotal</th>
					<th class="text-end" style="width:8%">Tax</th>
					<th class="text-end" style="width:8%">GST</th>
					<th class="text-end" style="width:8%">Amount</th>
					<th class="text-end">Status</th>
					<th class="" style="width:10%">Actions</th>
				@endif

			</tr>
		</thead>
		<!-- pol lines -->
		{{ $lines }}
		<!-- pol lines -->

		@if ( $readOnly )
			<!-- Table footer i.e. Totals -->
			<tr>
				<td class="" colspan="2">
					@if ($po->auth_status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
						<a href="{{ route('pols.add-line', $po->id) }}" class="text-warning d-inline-block"><i data-lucide="plus"></i> Add Lines</a>
					@endif
				</td>
				<td class="" colspan="3">&nbsp;</td>
				<td class="text-end" colspan="2"><strong>TOTAL ({{ $po->currency }}) :</strong></td>
				<td class="text-end"><strong><x-tenant.list.my-number :value="$po->sub_total"/></strong></td>
				<td class="text-end"><strong><x-tenant.list.my-number :value="$po->tax"/></strong></td>
				<td class="text-end"><strong><x-tenant.list.my-number :value="$po->gst"/></strong></td>
				<td class="text-end"><strong><x-tenant.list.my-number :value="$po->amount"/></strong></td>
				<td class="" colspan="2">&nbsp</td>
			</tr>
			<!-- End Table footer i.e. Totals -->
		@else
			<!-- Table footer i.e. Totals -->
			<tr class="">
				<td colspan="10" class="text-end">
					<strong>TOTAL:</strong>
				</td>
				<td class="text-end">
					<input type="number" step='0.01' min="1" class="form-control @error('po_amount') is-invalid @enderror"
						style="text-align: right;"
						name="po_amount" id="po_amount" placeholder="1.00"
						value="{{ old('po_amount', isset($po->amount) ? number_format($po->amount,2) : "0.00") }}"
						required readonly>
					@error('po_amount')
							<div class="small text-danger">{{ $message }}</div>
					@enderror
				</td>
				<td colspan="2">
					{{-- <x-tenant.buttons.show.save/> --}}
				</td>
			</tr>

			<!-- End Table footer i.e. Totals -->
		@endif
	</table>
</div>
