<tr class="">
	<td colspan="6" class="text-end">
		<strong>TOTAL:</strong>
	</td>
	<td class="text-end">
		<input type="number" step='0.01' min="1" class="form-control @error('amount') is-invalid @enderror"
			style="text-align: right;"
			name="amount" id="amount" placeholder="1.00"
			value="{{ old('amount',$po->amount) }}"
			required readonly>
		@error('amount')
				<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
	<td class="">
		{{-- <x-tenant.widgets.submit/> --}}
	</td>
</tr>
<tr class="">
	<td colspan="6" class="">

	</td>
	<td class="text-end">
		<a class="btn btn-secondary" href="{{ url()->previous() }}"><i data-feather="x-circle"></i> Cancel</a>
		<button type="submit" id="submit" name="action" value="save" class="btn btn-primary"><i data-feather="save"></i> Save</button>
		<button type="submit" id="submit" name="action" value="save_add" class="btn btn-primary"><i data-feather="save"></i> Save and Add Line</button>
	</td>
</tr>
