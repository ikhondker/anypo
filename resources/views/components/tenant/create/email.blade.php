<tr>
	<th class="text-success">Email :</th>
	<td>
		<input type="email" class="form-control @error('email') is-invalid @enderror"
		name="email" id="email" placeholder="you@example.com"
		value="{{ old('email', 'you@example.com' ) }}"
		required/>
	@error('email')
		<div class="small text-danger">{{ $message }}</div>
	@enderror
	</td>
</tr>
