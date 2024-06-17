<tr>
	<th>Email X:</th>
	<td>
		<input type="email" class="form-control @error('email') is-invalid @enderror"
			name="email" id="email" placeholder="you@example.com"
			value="{{ old('email', $value ) }}"
			required/>
		@error('email')
				<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
