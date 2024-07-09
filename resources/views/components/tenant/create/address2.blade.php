<tr>
	<th>Address2</th>
	<td>
		<input type="text" class="form-control @error('address2') is-invalid @enderror"
			name="address2" id="address2" placeholder="Address"
			value="{{ old('address2', '' ) }}"
			/>
		@error('address2')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
</tr>
