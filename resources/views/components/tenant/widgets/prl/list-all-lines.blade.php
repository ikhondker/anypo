<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<div class="dropdown position-relative">
				@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
					<a href="{{ route('prls.add-line', $pr->id) }}" class="btn btn-sm btn-light"><i data-lucide="plus-square"></i> Add Line</a>
				@endif
			</div>
		</div>
		<h5 class="card-title">Requisition Lines</h5>
		<h6 class="card-subtitle text-muted">List of Requisition Lines.</h6>
	</div>
	<table class="table table-striped table-sm">
		<thead>
			<tr>
					<th class="text-center" style="width:1%">#</th>
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
			</tr>
		</thead>

		<tbody>
			@forelse ($prls as $prl)
				<x-tenant.widgets.prl.card-table-row :line="$prl" :action="true"/>
			@empty

			@endforelse

			<!-- Table footer i.e. Totals -->
			<tr>
				<td class="" colspan="3" scope="col">
					@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
						<a href="{{ route('prls.add-line', $pr->id) }}" class="text-warning d-inline-block"><i data-lucide="plus-square"></i> Add Lines</a>
					@endif
				</td>
				<td class="" colspan="2" scope="col">&nbsp;</td>
				<td class="text-end" scope="col"><strong>TOTAL ({{ $pr->currency }}) :</strong></td>
				<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$pr->sub_total"/></strong></td>
				<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$pr->tax"/></strong></td>
				<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$pr->gst"/></strong></td>
				<td class="text-end" scope="col">{{ $pr->currency  }} <strong><x-tenant.list.my-number :value="$pr->amount"/></strong></td>
				<td class="" scope="col">&nbsp</td>
			</tr>
			<!-- End Table footer i.e. Totals -->
			
		</tbody>

	</table>

</div>