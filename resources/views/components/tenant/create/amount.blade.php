<tr>
	<th class="text-success">Amount ({{ $_setup->currency }}) :</th>
	<td>
		<input type="number" class="form-control @error('amount') is-invalid @enderror"
			style="text-align: right;" min="1" step="0.01" max="9999999.99"
			name="amount" id="amount" placeholder="0.00"
			value="{{ old('amount','0.00') }}"
			required>
		@error('amount')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
