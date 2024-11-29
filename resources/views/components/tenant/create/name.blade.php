<tr>
	<th width="25%" class="text-success">Name :</th>
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
