<tr>
	<th>Start Date </th>
	<td>
		<input type="date" class="form-control @error('start_date') is-invalid @enderror"
		name="start_date" id="start_date" placeholder=""
		value="{{ old('start_date', date('Y-m-d') ) }}"
		required/>
	@error('start_date')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
	</td>
</tr>
