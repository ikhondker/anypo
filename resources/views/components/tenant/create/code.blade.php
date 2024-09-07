<tr>
	<th>Code X:</th>
	<td>
		<input type="text" class="form-control @error('code') is-invalid @enderror"
			name="code" id="code" placeholder="XXX"
			style="text-transform: uppercase"
			value="{{ old('code', '' ) }}"
			required/>
		@error('code')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
