<tr>
	<th>Amount ({{ $_setup->currency }})</th>
	<td>
        <input type="number" class="form-control @error('amount') is-invalid @enderror"
            name="amount" id="amount" placeholder="99,99,999.99"
            step='0.01' min="1" value="{{ old('amount', '1.00' ) }}"
            required/>
        @error('amount')
            <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
	</td>
</tr>
