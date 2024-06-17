<tr>
	<th>Name X:</th>
	<td>
		<input type="text" class="form-control @error('name') is-invalid @enderror"
			name="name" id="name" placeholder="Name"
			value="{{ old('name', '' ) }}"
			required/>
		@error('name')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
