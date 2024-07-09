<tr>
	<th>Amount ({{ $_setup->currency }}) X:</th>
	<td>
		<input type="number" class="form-control @error('amount') is-invalid @enderror"
			name="amount" id="amount" placeholder="99,999.99"
			value="{{ old('amount', $value ) }}"
			step='0.01' min="0" required/>
		@error('amount')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
</tr>
