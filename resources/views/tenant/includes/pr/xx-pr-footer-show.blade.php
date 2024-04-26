<!-- Table footer i.e. Totals  -->
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
<!-- End Table footer i.e. Totals  -->