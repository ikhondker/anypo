<tr>
	<th>Website X:</th>
	<td>
		<input type="text" class="form-control @error('website') is-invalid @enderror"
			name="website" id="website" placeholder="https://www.example.com"
			value="{{ old('website', $value ) }}"
			/>
		@error('website')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
