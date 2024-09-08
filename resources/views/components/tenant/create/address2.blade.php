<tr>
	<th class="text-success">Address2 :</th>
	<td>
		<input type="text" class="form-control @error('address2') is-invalid @enderror"
			name="address2" id="address2" placeholder="Address"
			value="{{ old('address2', '' ) }}"
			/>
		@error('address2')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
