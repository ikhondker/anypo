<tr>
	<th width="25%" class="text-success">Summary :</th>
	<td>
		<input type="text" class="form-control @error('summary') is-invalid @enderror"
		name="summary" id="summary" placeholder="Summary"
		value="{{ old('summary', '' ) }}"
		required/>
	@error('summary')
		<div class="small text-danger">{{ $message }}</div>
	@enderror
	</td>
</tr>
