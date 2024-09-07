<tr>
	<th>Amount ({{ $_setup->currency }}) X:</th>
	<td>
		<input type="number" class="form-control @error('amount') is-invalid @enderror"
			name="amount" id="amount" placeholder="99,99,999.99"
			step='0.01' min="1" value="{{ old('amount', '1.00' ) }}"
			required/>
		@error('amount')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
