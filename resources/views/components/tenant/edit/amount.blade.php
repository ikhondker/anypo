<div class="mb-3">
	<label class="form-label">Amount ({{ $_setup->currency }}) X</label>
	<input type="number" class="form-control @error('amount') is-invalid @enderror"
		name="amount" id="amount" placeholder="99,999.99"
		value="{{ old('amount', $value ) }}"
		step='0.01' min="0" required/>
	@error('amount')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>