<tr>
	<th class="text-warning">Amount ({{ $_setup->currency }}) :</th>
	<td>
		<input type="number" class="form-control @error('amount') is-invalid @enderror"
			name="amount" id="amount" placeholder="99,999.99"
			value="{{ old('amount', $value ) }}"
			step='0.01' min="0" required/>
		@error('amount')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
