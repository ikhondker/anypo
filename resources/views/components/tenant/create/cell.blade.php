<tr>
	<th class="text-success">Cell :</th>
	<td>
		<input type="text" class="form-control @error('cell') is-invalid @enderror"
			name="cell" id="cell" placeholder="01911310509"
			value="{{ old('cell', '' ) }}"
			required/>
		@error('cell')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
