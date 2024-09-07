<tr>
	<th>LinkedIn X:</th>
	<td>
		<input type="text" class="form-control @error('linkedin') is-invalid @enderror"
			name="linkedin" id="linkedin" placeholder="https://www.linkedin.com/username"
			value="{{ old('linkedin', '' ) }}"
			required/>
		@error('linkedin')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
