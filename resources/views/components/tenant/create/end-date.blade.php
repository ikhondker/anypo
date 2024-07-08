<tr>
	<th>End Date </th>
	<td>
        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
		name="end_date" id="end_date" placeholder=""
		value="{{ old('end_date', date('Y-m-d') ) }}"
		required/>
	@error('end_date')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
	</td>
</tr>
