<tr>
	<th class="text-warning">Code :</th>
	<td>
		<input type="text" class="form-control @error('code') is-invalid @enderror"
			name="code" id="code"placeholder="XXXX"
			value="{{ old('code', $value ) }}"
			style="text-transform: uppercase"
			required/>
		@error('code')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>

