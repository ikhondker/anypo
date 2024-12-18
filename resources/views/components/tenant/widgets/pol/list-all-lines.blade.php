<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<div class="dropdown position-relative">
				@can('update', $po)
					<a href="{{ route('pols.add-line', $po->id) }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Add Line</a>
				@endcan
			</div>
		</div>
		<h5 class="card-title">Purchase Order Lines</h5>
		<h6 class="card-subtitle text-muted">List of Purchase Order Lines.</h6>
	</div>
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th style="width:2%">LN#</th>
				<th style="width:5%" >Item</th>
				<th style="width:23%">Description</th>
				<th style="width:7%">UOM</th>
				<th class="text-end" style="width:5%">Qty</th>
				<th class="text-end" style="width:5%">Received</th>
				<th class="text-end" style="width:9%">Price</th>
				<th class="text-end" style="width:8%">Subtotal</th>
				<th class="text-end" style="width:8%">Tax</th>
				<th class="text-end" style="width:8%">GST</th>
				<th class="text-end" style="width:8%">Amount</th>
				<th class="text-end">Status</th>
				<th class="" style="width:10%">Actions</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($pols as $pol)
				<x-tenant.widgets.pol.card-table-row :line="$pol" :action="true"/>
			@empty

			@endforelse

			<!-- Table footer i.e. Totals -->
			<tr>
				<td class="" colspan="2">
				 @can('update', $po)
					<a href="{{ route('pols.add-line', $po->id) }}" class="text-warning d-inline-block"><i data-lucide="plus"></i> Add Lines</a>
				@endcan
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
		</tbody>

	</table>
</div>
