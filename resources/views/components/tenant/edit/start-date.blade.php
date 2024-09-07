<tr>
	<th class="text-warning">Start Date :</th>
	<td>
		<input type="date" class="form-control @error('start_date') is-invalid @enderror"
			name="start_date" id="start_date" placeholder=""
			value="{{ old('start_date', $value ) }}"
			required/>
		@error('start_date')
			<div class="small text-danger">{{ $message }}</div>
		@enderror
	</td>
</tr>
