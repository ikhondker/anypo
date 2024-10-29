<tr>
	<th class="text-warning">Amount ({{ $_setup->currency }}) :</th>
	<td>
		<input type="number" class="form-control @error('amount') is-invalid @enderror"
			min="0" step="0.01" max="99999999.99"
			name="amount" id="amount" placeholder="99,999,999.99"
			value="{{ old('amount', $value ) }}"
			required/>
		@error('amount')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
