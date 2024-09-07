<tr>
	<th>Facebook X:</th>
	<td>
		<input type="text" class="form-control @error('facebook') is-invalid @enderror"
			name="facebook" id="facebook" placeholder="https://www.facebook.com/username"
			value="{{ old('facebook', '' ) }}"
			required/>
		@error('facebook')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
