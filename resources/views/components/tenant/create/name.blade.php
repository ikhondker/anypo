<tr>
	<th>Name</th>
	<td>
        <input type="text" class="form-control @error('name') is-invalid @enderror"
		name="name" id="name" placeholder="Name"
		value="{{ old('name', '' ) }}"
		required/>
	@error('name')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
	</td>
</tr>
