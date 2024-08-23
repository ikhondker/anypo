
<tr>
	<th>Summary X:</th>
	<td>
		<input type="text" class="form-control @error('summary') is-invalid @enderror"
			name="summary" id="summary" placeholder="Summary"
			value="{{ old('summary', $value ) }}"
			required/>
		@error('summary')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</td>
</tr>
