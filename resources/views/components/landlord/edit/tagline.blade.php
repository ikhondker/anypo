<tr>
	<th>Tagline X:</th>
	<td>
		<input type="text" class="form-control @error('name') is-invalid @enderror"
			name="tagline" id="tagline" placeholder="Tagline"
			value="{{ old('tagline', $value ) }}"
			/>
		@error('tagline')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
