
<tr>
	<th class="text-warning">Address2 :</th>
	<td>
		<input type="text" class="form-control @error('address2') is-invalid @enderror"
			name="address2" id="address2" placeholder="Address 2"
			value="{{ old('address2', $value ) }}"
			/>
		@error('address2')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>

