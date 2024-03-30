<!-- Table footer i.e. Totals  -->
<tr>
	<td class="" colspan="2" scope="col"> 
		@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
			<a href="{{ route('pols.add-line', $po->id) }}" class="text-warning d-inline-block"><i data-feather="plus-square"></i> Add Lines</a>
		@endif
	</td>
	<td class="" colspan="4" scope="col">&nbsp;</td>
	<td class="text-end" scope="col"><strong>TOTAL ({{ $po->currency }}) :</strong></td>
	<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->sub_total"/></strong></td>
	<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->tax"/></strong></td>
	<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->gst"/></strong></td>
	<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$po->amount"/></strong></td>
	<td class="" scope="col">&nbsp</td>
</tr>
<!-- End Table footer i.e. Totals  -->