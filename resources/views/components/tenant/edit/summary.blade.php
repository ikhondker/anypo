
<tr>
	<th class="text-warning">Summary :</th>
	<td>
		<input type="text" class="form-control @error('summary') is-invalid @enderror"
			name="summary" id="summary" placeholder="Summary"
			value="{{ old('summary', $value ) }}"
			required/>
		@error('summary')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
