{{-- ================================================================== --}}

		<tr>
			<td class="" colspan="5" scope="col">&nbsp;</td>
			<td class="text-end" scope="col"><strong>Subtotal:</strong></td>
			<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$pr->sub_total"/></strong></td>
			<td class="" scope="col">&nbsp</td>
		</tr>

		<tr>
			<td class="" colspan="5" scope="col">&nbsp;</td>
			<td class="text-end" scope="col">Tax:</td>
			<td class="text-end" scope="col"><x-tenant.list.my-number :value="$pr->tax"/></td>
			<td class="" scope="col">&nbsp</td>
		</tr>
		<tr>
			<td class="" colspan="5" scope="col">&nbsp;</td>
			<td class="text-end" scope="col">Shipping:</td>
			<td class="text-end" scope="col"><x-tenant.list.my-number :value="$pr->shipping"/></td>
			<td class="" scope="col">&nbsp</td>
		</tr>
		<tr>
			<td class="" colspan="5" scope="col">&nbsp;</td>
			<td class="text-end" scope="col">Discount (-):</td>
			<td class="text-end" scope="col"><x-tenant.list.my-number :value="$pr->discount"/></td>
			<td class="" scope="col">&nbsp</td>
		</tr>

		<tr>
			<td class="" colspan="5" scope="col">&nbsp;</td>
			<td class="text-end" scope="col"><strong>Total:</strong></td>
			<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$pr->amount"/></strong></td>
			<td class="" scope="col">&nbsp</td>
		</tr>
					   

{{-- ============================================================== --}}